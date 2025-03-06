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

const store = useUserStore();
const { user } = storeToRefs(store);

const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
        userName: yup.string().required(),
    }),
});

const [userName, userNameAttrs] = defineField('userName');
userName.value = user.value.name
const onChangeUserName = handleSubmit(async values => {
    const response = await fetch('http://api.local/api/user/name/change', {
        method: "POST",
        body: JSON.stringify(values),
        // credentials: "include",
        mode: 'cors',
        headers: { Cookie: document.cookie }
    });
    console.log(document.cookie)
    const data = await response.json();
    console.log(data)
});


</script>
<template>
    <form class="form" @submit="onChangeUserName">
        <div class="form-user-name--container">
            <input class="user-name-input" :class="{ 'user-name-input--error': errors.userName }" type="text"
                v-model="userName" v-bind="userNameAttrs" placeholder="Имя" />
            <ErrorMessage v-if="errors.userName" text="Имя является обязательным полем" />
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
</style>