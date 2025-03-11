<script setup lang="ts">
const {
    closeModal,
} = defineProps<{
    closeModal(): void,
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
        name: yup.string().required(),
    }),
});
const errorsForm = ref("")
const [name, nameAttrs] = defineField('name');
name.value = user.value.name ?? ""
const onChangeUserName = handleSubmit(async values => {
    if (user.value.id) {
        const response = await fetch('http://api.local/api/user/name/change', {
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
            closeModal()
        }
        else {
            if (data.message.includes("User is not authorized")) {
                errorsForm.value = "Вы не авторизированны"
            }
            else {
                errorsForm.value = data.message
            }
        }
    }
    else {
        if (values.name) {
            const updateUserData = {
                ...user.value,
                name: values.name,
            }
            user.value = updateUserData
            closeModal()
        }
    }
});

</script>
<template>
    <form class="form" @submit="onChangeUserName">
        <div class="form-user-name--container">
            <input class="user-name-input" :class="{ 'user-name-input--error': errors.name }" type="text" v-model="name"
                v-bind="nameAttrs" placeholder="Имя" />
            <ErrorMessage v-if="errors.name" text="Имя является обязательным полем" />
            <ErrorMessage v-if="errorsForm" :text="errorsForm" />
        </div>
        <Btn view="addres-or-order">
            Подтевердить изменения
        </Btn>
    </form>
</template>
<style scoped>
.user-name-input {
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

.user-name-input--error {
    border: 1.5px solid var(--pink);
}
</style>