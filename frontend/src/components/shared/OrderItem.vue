<script setup lang="ts">
import router from '@/router';
import { useOrderStore } from '@/stores/order';
import { storeToRefs } from 'pinia';

const {
    id,
    addres_sity,
    addres_house,
    addres_name_addres,
    cost,
    buyer_name,
    buyer_email,
    created_at,
    status
} = defineProps<{

    id: number
    addres_sity: string,
    addres_house: string,
    addres_name_addres: string,
    cost: number,
    buyer_name: string,
    buyer_email: string,
    created_at: string,
    status:string

}>();

const storeOrder = useOrderStore();
const { order } = storeToRefs(storeOrder)
const openOrder = async () => {

    const response = await fetch(`http://api.local/api/order/${id}`, {
        method: "GET",
        mode: 'cors'
    });
    const data = await response.json();
    order.value = data
    console.log(data)

    router.push({
        path: '/order',
    })
}

</script>
<template>
    <button class="order-item" @click="openOrder()">
        <div class="order-item__info-container">
            <p class="order-item__info-title">Номер</p>
            <p class="order-item__info-text">{{ id }}</p>
        </div>
        <div class="order-item__info-container" v-if="addres_name_addres">
            <p class="order-item__info-title">Имя адреса</p>
            <p class="order-item__info-text order-item__info-text--yellow" >{{ addres_name_addres }}</p>
        </div>
        <div class="order-item__info-container" v-if="addres_sity">
            <p class="order-item__info-title">Город и улица</p>
            <p class="order-item__info-text">{{ addres_sity }}</p>
        </div>
        <div class="order-item__info-container" v-if="addres_house">
            <p class="order-item__info-title">Дом</p>
            <p class="order-item__info-text">{{ addres_house }}</p>
        </div>
        <div class="order-item__info-container">
            <p class="order-item__info-title">Цена</p>
            <p class="order-item__info-text order-item__info-text--yellow">{{ cost }}</p>
        </div>
        <div class="order-item__info-container" v-if="!addres_name_addres && !addres_sity && !addres_house">
            <p class="order-item__info-title">Доставка</p>
            <p class="order-item__info-text order-item__info-text--yellow">Самовывоз</p>
        </div>
        <div class="order-item__info-container">
            <p class="order-item__info-title">Имя</p>
            <p class="order-item__info-text">{{ buyer_name }}</p>
        </div>
        <div class="order-item__info-container">
            <p class="order-item__info-title">Почта</p>
            <p class="order-item__info-text">{{ buyer_email }}</p>
        </div>
        <div class="order-item__info-container">
            <p class="order-item__info-title">Дата</p>
            <p class="order-item__info-text">{{ created_at }}</p>
        </div>
        <div class="order-item__info-container">
            <p class="order-item__info-title">Статус</p>
            <p class="order-item__info-text">{{ status }}</p>
        </div>
    </button>
</template>

<style scoped>
.order-item {
    display: flex;
    flex-direction: column;
    gap: 15px;
    background: var(--white);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 400px;
    padding: 20px;
}

.order-item__info-container {
    display: flex;
}

.order-item__info-title {
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
    opacity: 0.7;
    width: 120px;
}

.order-item__info-text {
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.82;
}

.order-item__info-text--yellow {
    color: var(--yellow);
}
</style>
