<script setup lang="ts">
const {
    close,
} = defineProps<{
    close(): void,
}>();
import { ref } from 'vue';
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import { system } from '@ankasru/utils-ts';
import ErrorMessage from '../shared/ErrorMessage.vue';
import Btn from './Btn.vue';
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';

const store = useUserStore();
const { user } = storeToRefs(store);

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

function clearErrorsMessage() {
    answerMessageForRegistration.value = ""
    answerMessageForLoginPassword.value = ""
    answerMessageForLoginEmail.value = ""
}

const onLogin = loginHandleSubmit(async values => {
    clearErrorsMessage();

    const response = await fetch('http://api.local/api/auth/login', {
        method: "POST",
        body: JSON.stringify(values),
        mode: 'cors'
    });

    const data = await response.json();
    const cookies = system.parseCookies()

    if (data.success) {
        close()
        if (cookies) {
            cookies.setCookie({ name: "session", value: JSON.stringify({ user_id: data.session_id }) })
        }

        const updateUser = {
            ...user.value,
            name: data.user.name,
            email: data.user.email,
            id: data.user.id
        }
        user.value = updateUser
        return
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
    clearErrorsMessage();

    const response = await fetch('http://api.local/api/auth/registration', {
        method: "POST",
        body: JSON.stringify(values),
        mode: 'cors'
    });

    const data = await response.json();
    console.log(data)
    const cookies = system.parseCookies();

    if (data.success) {
        close()

        if (cookies) {
            cookies.setCookie({ name: "session", value: JSON.stringify({ user_id: data.user.id }) })
        }

        const updateUser = {
            ...user.value,
            name: data.user.name,
            email: data.user.email,
            id: data.user.id
        }
        console.log(data)
        user.value = updateUser
        return
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
    <div class="radio--container">
        <input class="radio--input" type="radio" id="regist" @change="changeForm()" checked name="auth">
        <input class="radio--input" type="radio" id="login" @change="changeForm()" name="auth">
        <label class="radio-regist--label" htmlFor="regist">
            <p class="radio-regist--text">Регистрация</p>
        </label>
        <label class="radio-login--label" htmlFor="login">
            <p class="radio-login--text">Вход</p>
        </label>
    </div>
    <div class="form--container" v-if="formIsRegistration">
        <form class="form" @submit="onRegister">
            <div class="input-and-errors--contsiner">
                <input class="input" :class="{ 'input--error': registerErrors.name }" type="text" v-model="registerName"
                    v-bind="registerNameAttrs" placeholder="Имя" />
                <ErrorMessage v-if="registerErrors.name" text="Имя является обязательным полем" />
            </div>

            <div class="input-and-errors--contsiner">
                <input class="input" :class="{ 'input--error': registerErrors.email || answerMessageForRegistration }"
                    type="email" v-model="registerEmail" v-bind="registerEmailAttrs" placeholder="Email" />
                <ErrorMessage v-if="registerErrors.email" text="Email является обязательным полем" />
                <ErrorMessage v-if="answerMessageForRegistration" :text="answerMessageForRegistration" />
            </div>

            <div class="input-and-errors--contsiner">
                <input class="input" :class="{ 'input--error': registerErrors.password }" type="password"
                    v-model="registerPassword" v-bind="registerPasswordAttrs" placeholder="Пароль" />
                <ErrorMessage v-if="registerErrors.password" text="Пароль минимум из 6 символов" />
            </div>

            <Btn view="addres-or-order">
                Зарегистрироваться
            </Btn>
        </form>
    </div>
    <div class="form--container" v-else>
        <form class="form" @submit="onLogin">
            <input class="input" :class="{ 'input--error': loginErrors.email }" type="email" v-model="loginEmail"
                v-bind="loginEmailAttrs" placeholder="email" />
            <ErrorMessage v-if="loginErrors.email" text="Email является обязательным полем" />
            <ErrorMessage v-if="answerMessageForLoginEmail" :text="answerMessageForLoginEmail" />

            <input class="input" :class="{ 'input--error': loginErrors.password }" type="password"
                v-model="loginPassword" v-bind="loginPasswordAttrs" placeholder="password" />
            <ErrorMessage v-if="loginErrors.password" text="Пароль минимум из 6 символов" />
            <ErrorMessage v-if="answerMessageForLoginPassword" :text="answerMessageForLoginPassword" />

            <Btn view="addres-or-order">
                Войти
            </Btn>
        </form>
    </div>
</template>
<style scoped>
.radio--input {
    display: none;
}

.radio--container {
    display: flex;
    gap: 12px;
}

.radio-regist--label,
.radio-login--label {
    padding: 10px 36px;
    background-color: var(--gray-light);
    border-radius: 8px;
    width: 100%;
    text-align: center;
}

.radio-regist--text,
.radio-login--text {
    color: var(--v5-gray-little-dark);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
}

#regist:checked~.radio-regist--label {
    background-color: var(--yellow);
}

#regist:checked~.radio-regist--label .radio-regist--text {
    background-color: var(--yellow);
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-weight: 700;
}

#login:checked~.radio-login--label {
    background-color: var(--yellow);
}

#login:checked~.radio-login--label .radio-login--text {
    background-color: var(--yellow);
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-weight: 700;
}

.form {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 10px;
}

.input {
    height: 48.0px;
    border-radius: 8px;
    border: 1.5px solid var(--v4-gray-little-dark);
    padding-left: 20px;

    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}

.input--error {
    border: 1.5px solid var(--pink);
}

.input-and-errors--contsiner {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.input--message-error {
    color: red;
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}
</style>