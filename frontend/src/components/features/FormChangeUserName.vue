<script setup lang="ts">
const {
    OpenOrclose,
} = defineProps<{
    OpenOrclose(): void,
}>();
import { ref } from 'vue';
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import ErrorMessage from '../shared/ErrorMessage.vue';
import Btn from './Btn.vue';
import { storeToRefs } from 'pinia';
import { useBacketStore } from '@/stores/backet';

const store = useBacketStore();
const { delivery } = storeToRefs(store);

const { errors, handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
        nameAddres: yup.string().required(),
    }),
});

const [nameAddres, nameAddresAttrs] = defineField('nameAddres');

nameAddres.value = delivery?.value?.addres?.nameAddres

const formIsRegistration = ref(true)

const sendAddres = handleSubmit(async values => {

    console.log(values)
});


</script>
<template>
    <div class="form--container" v-if="formIsRegistration">
        <form class="form" @submit="sendAddres">
            <div class="form-name-addres--container">
                <input class="input name-addres--input" type="text" v-model="nameAddres" v-bind="nameAddresAttrs"
                    placeholder="Название адреса" />
            </div>
            <Btn class="form--btn" view="addres-or-order">
                Подтевердить адрес
            </Btn>
        </form>
    </div>
</template>
<style scoped>
.form--btn {
    max-width: 224px;
    margin-top: 33px;
}

.name-addres-example {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}

.name-addres-example--yellow {
    color: var(--yellow);
}

.form-name-addres--container {
    display: flex;
    flex-direction: column;
    margin-top: 11px;
}

.radio--input {
    display: none;
}

.delivery-radio--container {
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

#delivery:checked~.radio-regist--label {
    background-color: var(--yellow);
}

#delivery:checked~.radio-regist--label .radio-regist--text {
    background-color: var(--yellow);
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-weight: 700;
}

#self-delivery:checked~.radio-login--label {
    background-color: var(--yellow);
}

#self-delivery:checked~.radio-login--label .radio-login--text {
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

.form-addres--container {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
}

.input {
    height: 48px;
    border-radius: 8px;
    border: 1.5px solid var(--v4-gray-little-dark);
    padding-left: 20px;
    width: 133px;

    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}

.input--long {
    width: 100%;
    max-width: 426px;
}

.name-addres--input {
    width: 100%;
}

.coment--textarea {
    width: 100%;
    max-width: 100%;
}

.input--error {
    border: 1.5px solid var(--pink);
}

.input-and-errors--contsiner {
    display: flex;
    flex-direction: column;
    gap: 5px;

    width: 100%;
    max-width: 133px;
}

.input-and-errors--contsiner--long {
    max-width: 426px;
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