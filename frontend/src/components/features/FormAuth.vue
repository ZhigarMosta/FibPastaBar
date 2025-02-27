<script setup lang="ts">
const {
    OpenOrclose,
    modalIsOpen,
} = defineProps<{
    modalIsOpen: boolean
    OpenOrclose: (modalIsOpen: boolean) => {},
}>();
import { ref } from 'vue';
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import { system } from '@ankasru/utils-ts';

const { errors: loginErrors, handleSubmit: loginHandleSubmit, defineField: loginDefineField } = useForm({
    validationSchema: yup.object({
        email: yup.string().email().required(),
        password: yup.string().min(6).required(),
    }),
});

const { errors: registerErrors, handleSubmit: registerHandleSubmit, defineField: registerDefineField } = useForm({
    validationSchema: yup.object({
        name: yup.string().required(),
        email: yup.string().required(),
        password: yup.string().min(6).required(),
    }),
});

const [registerEmail, registerEmailAttrs] = registerDefineField('email');
const [registerPassword, registerPasswordAttrs] = registerDefineField('password');
const [registerName, registerNameAttrs] = registerDefineField('name');

const [loginEmail, loginEmailAttrs] = loginDefineField('email');
const [loginPassword, loginPasswordAttrs] = loginDefineField('password');
const formIsRegistration = ref(true)

function changeForm() {
    formIsRegistration.value = !formIsRegistration.value
}

const answerMessageForRegistration = ref("")
const answerMessageForLoginPassword = ref("")
const answerMessageForLoginEmail = ref("")

function crearErrorsMessage() {
    answerMessageForRegistration.value = ""
    answerMessageForLoginPassword.value = ""
    answerMessageForLoginEmail.value = ""
}

const onLogin = loginHandleSubmit(async values => {
    crearErrorsMessage();

    const response = await fetch('http://api.local/api/auth/login', {
        method: "POST",
        body: JSON.stringify(values),
        mode: 'cors'
    });

    const data = await response.json();
    const cookies = system.parseCookies()

    if (data.success) {
        OpenOrclose(modalIsOpen)

        if (cookies) {
            cookies.setCookie({ name: "session", value: JSON.stringify({ user_id: data.session_id }) })
        }
    }

    if (data.message.includes("Not found user with email")) {
        answerMessageForLoginEmail.value = data.message
    }
    if (data.message.includes("Invalid password")) {
        answerMessageForLoginPassword.value = data.message
    }
    else {
        answerMessageForLoginEmail.value = data.message
    }

});
const onRegister = registerHandleSubmit(async values => {
    crearErrorsMessage();

    const response = await fetch('http://api.local/api/auth/registration', {
        method: "POST",
        body: JSON.stringify(values),
        mode: 'cors'
    });

    const data = await response.json();
    const cookies = system.parseCookies();

    if (data.success) {
        OpenOrclose(modalIsOpen)

        if (cookies) {
            cookies.setCookie({ name: "session", value: JSON.stringify({ user_id: data.user.id }) })
        }
    }

    if (data.message.includes("Users.emailUnique")) {
        answerMessageForRegistration.value = "Пользователь с такой почтой уже существует"
    }
    else {
        answerMessageForRegistration.value = data.message
    }
});
</script>
<template>
    <div class="auth-radio">
        <input type="radio" @change="changeForm()" checked name="auth">
        <label>Регистрация</label>
        <input type="radio" @change="changeForm()" name="auth">
        <label>Вход</label>
    </div>
    <div class="form--container" v-if="formIsRegistration">
        <form class="form" @submit="onRegister">
            <input :class="{ 'input--error': registerErrors.name }" type="text" v-model="registerName"
                v-bind="registerNameAttrs" placeholder="name" />
            <p v-if="registerErrors.name">Имя является обязательным полем</p>

            <input :class="{ 'input--error': registerErrors.email || answerMessageForRegistration }" type="email"
                v-model="registerEmail" v-bind="registerEmailAttrs" placeholder="email" />
            <p v-if="registerErrors.email">Email является обязательным полем</p>
            <p v-if="answerMessageForRegistration">{{ answerMessageForRegistration }}</p>

            <input :class="{ 'input--error': registerErrors.password }" type="password" v-model="registerPassword"
                v-bind="registerPasswordAttrs" placeholder="password" />
            <p v-if="registerErrors.password">Пароль минимум из 6 символов</p>

            <button>Submit</button>
        </form>
    </div>
    <div class="form--container" v-else>
        <form class="form" @submit="onLogin">
            <input :class="{ 'input--error': loginErrors.email }" type="email" v-model="loginEmail"
                v-bind="loginEmailAttrs" placeholder="email" />
            <p v-if="loginErrors.email">Email является обязательным полем</p>
            <p v-if="answerMessageForLoginEmail">{{ answerMessageForLoginEmail }}</p>

            <input :class="{ 'input--error': loginErrors.password }" type="text" v-model="loginPassword"
                v-bind="loginPasswordAttrs" placeholder="password" />
            <p v-if="loginErrors.password">Пароль минимум из 6 символов</p>
            <p v-if="answerMessageForLoginPassword">{{ answerMessageForLoginPassword }}</p>

            <button>Submit</button>
        </form>
    </div>
</template>
<style scoped>
.form {
    display: flex;
    flex-direction: column;
}

.input--error {
    color: red;
}
</style>