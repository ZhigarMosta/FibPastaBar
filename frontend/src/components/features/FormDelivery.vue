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
        sity: yup.string().required(),
        house: yup.string().required(),
        entrance: yup.string().required(),
        apartment: yup.string().required(),
        floor: yup.string().required(),
        code: yup.string(),
        nameAddres: yup.string(),
        comentAddres: yup.string()
    }),
});

const [sity, sityAttrs] = defineField('sity');
const [house, houseAttrs] = defineField('house');
const [entrance, entranceAttrs] = defineField('entrance');
const [apartment, apartmentAttrs] = defineField('apartment');
const [floor, floorAttrs] = defineField('floor');
const [code, codeAttrs] = defineField('code');
const [nameAddres, nameAddresAttrs] = defineField('nameAddres');
const [commentAddres, comentAddresAttrs] = defineField('comentAddres');

sity.value = delivery?.value?.addres?.sity
house.value = delivery?.value?.addres?.house
entrance.value = delivery?.value?.addres?.entrance
apartment.value = delivery?.value?.addres?.apartment
floor.value = delivery?.value?.addres?.floor
code.value = delivery?.value?.addres?.code
nameAddres.value = delivery?.value?.addres?.nameAddres
commentAddres.value = delivery?.value?.addres?.commentAddres

const formIsRegistration = ref(true)

function changeForm() {
    formIsRegistration.value = !formIsRegistration.value
}

const sendAddres = handleSubmit(async values => {
    const updatedAddress = {
        ...delivery.value,
        addres: {
            sity: values.sity,
            house: values.house,
            entrance: values.entrance,
            apartment: values.apartment,
            floor: values.floor,
            code: values.code || delivery?.value?.addres?.code,
            nameAddres: values.nameAddres || delivery?.value?.addres?.nameAddres,
            commentAddres: values.commentAddres || delivery?.value?.addres?.commentAddres
        },
        pickup: false
    };

    delivery.value = updatedAddress;

    OpenOrclose()
});

const sendPickup = () => {
    const updatedAddress = {
        ...delivery.value,
        addres: {
            sity: delivery?.value?.addres?.sity,
            house: delivery?.value?.addres?.house,
            entrance: delivery?.value?.addres?.entrance,
            apartment: delivery?.value?.addres?.apartment,
            floor: delivery?.value?.addres?.floor,
            code: delivery?.value?.addres?.code,
            nameAddres: delivery?.value?.addres?.nameAddres,
            commentAddres: delivery?.value?.addres?.commentAddres
        },
        pickup: true
    };

    delivery.value = updatedAddress;

    OpenOrclose()
}

</script>
<template>
    <div class="delivery-radio--container">
        <input class="radio--input" type="radio" id="delivery" @change="changeForm()" checked name="deliverеy">
        <input class="radio--input" type="radio" id="self-delivery" @change="changeForm()" name="deliverеy">
        <label class="radio-regist--label" htmlFor="delivery">
            <p class="radio-regist--text">Доставка</p>
        </label>
        <label class="radio-login--label" htmlFor="self-delivery">
            <p class="radio-login--text">Самовывоз</p>
        </label>
    </div>
    <div class="form--container" v-if="formIsRegistration">
        <form class="form" @submit="sendAddres">
            <div class="form-addres--container">
                <div class="input-and-errors--contsiner input-and-errors--contsiner--long">
                    <input class="input input--long" :class="{ 'input--error': errors.sity }" type="text" v-model="sity"
                        v-bind="sityAttrs" placeholder="Город, улица" />
                    <ErrorMessage v-if="errors.sity" text="Заполните" />
                </div>

                <div class="input-and-errors--contsiner">
                    <input class="input" :class="{ 'input--error': errors.house }" type="text" v-model="house"
                        v-bind="houseAttrs" placeholder="Дом" />
                    <ErrorMessage v-if="errors.house" text="Заполните" />
                </div>

                <div class="input-and-errors--contsiner">
                    <input class="input" :class="{ 'input--error': errors.entrance }" type="text" v-model="entrance"
                        v-bind="entranceAttrs" placeholder="Подъезд" />
                    <ErrorMessage v-if="errors.entrance" text="Заполните" />
                </div>
                <div class="input-and-errors--contsiner">
                    <input class="input" :class="{ 'input--error': errors.apartment }" type="text" v-model="apartment"
                        v-bind="apartmentAttrs" placeholder="Квартира" />
                    <ErrorMessage v-if="errors.apartment" text="Заполните" />
                </div>
                <div class="input-and-errors--contsiner">
                    <input class="input" :class="{ 'input--error': errors.floor }" type="text" v-model="floor"
                        v-bind="floorAttrs" placeholder="Этаж" />
                    <ErrorMessage v-if="errors.floor" text="Заполните" />
                </div>
                <div class="input-and-errors--contsiner">
                    <input class="input" type="text" v-model="code" v-bind="codeAttrs" placeholder="Код" />
                </div>
            </div>
            <div class="form-name-addres--container">
                <input class="input name-addres--input" type="text" v-model="nameAddres" v-bind="nameAddresAttrs"
                    placeholder="Название адреса" />
                <p class="name-addres-example">Например, <span class="name-addres-example--yellow">Дом</span> или <span
                        class="name-addres-example--yellow">Работа</span></p>
            </div>
            <textarea class="input coment--textarea" placeholder="Комментарий к адресу" v-model="commentAddres"
                v-bind="comentAddresAttrs"></textarea>
            <Btn class="form--btn" view="addres-or-order">
                Подтевердить адрес
            </Btn>
        </form>
    </div>
    <div class="form--container" v-else>
        <form class="form" @submit="sendPickup">
            <Btn view="addres-or-order">
                Подтевердить самовывоз
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