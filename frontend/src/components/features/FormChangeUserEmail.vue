<script setup lang="ts">
const {
    OpenOrclose,
} = defineProps<{
    OpenOrclose(): void,
}>();
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import ErrorMessage from '../shared/ErrorMessage.vue';
import Btn from './Btn.vue';
import { storeToRefs } from 'pinia';
import { useUserStore } from '@/stores/user';
import { ref } from 'vue';

const store = useUserStore();
const { user } = storeToRefs(store);

const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
        email: yup.string().email().required(),
    }),
});
const errorsForm = ref("")
const [email, emailAttrs] = defineField('email');
email.value = user.value.email ?? ""
const onChangeUserName = handleSubmit(async values => {
    if (user.value.id) {
        const response = await fetch('http://api.local/api/user/email/change', {
            method: "POST",
            body: JSON.stringify({ ...values, userId: user.value.id, }),
            credentials: "include",
            mode: 'cors',
        });
        console.log(user.value.id)
        const data = await response.json();
        console.log(data)
        if (data.success) {
            const updateUserData = {
                ...user.value,
                name: data.user.name,
                email: data.user.email,
                id: data.user.id
            }
            user.value = updateUserData
            OpenOrclose()
            return
        }

        if (data.message.includes("User is not authorized")) {
            errorsForm.value = "Вы не авторизированны"
        }
        else if (data.message.includes("A user with this email already exists")) {
            errorsForm.value = "Пользователь с такой почтой уже существует"
        }
        else {
            errorsForm.value = data.message
        }
    }
    else {
        if (values.email) {
            const updateUserData = {
                ...user.value,
                email: values.email,
            }
            user.value = updateUserData
            OpenOrclose()
        }
    }

});

</script>
<template>
    <form class="form" @submit="onChangeUserName">
        <div class="form-user-email--container">
            <input class="user-email-input" :class="{ 'user-email-input--error': errors.email }" type="email"
                v-model="email" v-bind="emailAttrs" placeholder="Почта" />
            <ErrorMessage v-if="errors.email" text="Email является обязательным полем" />
            <ErrorMessage v-if="errorsForm" :text="errorsForm" />
        </div>
        <Btn view="addres-or-order">
            Подтевердить изменения
        </Btn>
    </form>
</template>
<style scoped>
.user-email-input {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.82;

    width: 100%;
    height: 48px;
    border-radius: 8px;
    border: 1.5px solid var(--v5-gray-little-dark);
    padding-left: 20px;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.user-email-input--error {
    border: 1.5px solid var(--pink);
}
</style>