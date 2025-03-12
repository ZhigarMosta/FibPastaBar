<script setup lang="ts">
import { useOrderStore } from '@/stores/order';
import { storeToRefs } from 'pinia';
import Btn from './Btn.vue';
import router from '@/router';

const UserStore = useOrderStore();
const { order } = storeToRefs(UserStore);

const redirectToHomeAndClearBacketStore = () => {
    router.push({
        path: '/',
    })
}

</script>
<template>
    <div class="info-order">
        <div class="info-order__item-container">
            <p class="info-order__title">Имя адреса</p>
            <p class="info-order__info--addres-name">{{ order?.order.addres_name_addres }}</p>
        </div>
        <div class="info-order__item-container">
            <p class="info-order__title">Имя</p>
            <p class="info-order__info">{{ order?.order.buyer_name }}</p>
        </div>
        <div class="info-order__item-container">
            <p class="info-order__title">Почта</p>
            <p class="info-order__info">{{ order?.order.buyer_email }}</p>
        </div>
        <div class="info-order__item-container">
            <p class="info-order__title">Промокод</p>
            <p class="info-order__info--promocode">{{ order?.promotional_code?.code }}</p>
        </div>
        <div class="info-order__item-container--addres"
            v-if="order?.order.addres_apartment && order?.order.addres_entrance && order?.order.addres_floor && order?.order.addres_house && order?.order.addres_sity">
            <p class="info-order__title">Адрес</p>
            <p class="info-order__info">Город и улица: <span class="info-order_addres">{{ order?.order.addres_sity
                    }}</span> Дом: <span class="info-order_addres">{{ order?.order.addres_house }}</span> Этаж: <span
                    class="info-order_addres">{{ order?.order.addres_floor
                    }}</span> Подъезд: <span class="info-order_addres">{{ order?.order.addres_entrance }}</span>
                Квартира: <span class="info-order_addres">{{ order?.order.addres_apartment }}</span> </p>
        </div>
        <div class="info-order__item-container" v-else>
            <p class="info-order__title">Адрес</p>
            <p class="info-order__info info-order_addres">Самовызов</p>
        </div>
        <Btn class="info-order_router" :fn="() => redirectToHomeAndClearBacketStore()" view="look">На главную</Btn>
    </div>
</template>
<style scoped>
.info-order_router {
    width: 100%;
    background-color: var(--yellow);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 40px;
    border-radius: 8px;

    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;

    transition: color 0.3s ease-in-out;
}

.info-order_router:hover {
    color: var(--white);
}

.gratitude__btn {
    width: 100%;
}

.info-order {
    background: var(--white);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 400px;
    padding: 20px;

    display: flex;
    flex-direction: column;
    gap: 10px;
}

.info-order__item-container {
    display: flex;
    /* justify-content: space-between; */
    gap: 10px;
}

.info-order__title {
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
    opacity: 0.7;
    width: 120px;
}

.info-order__info--addres-name {
    color: var(--yellow);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.82;
    min-width: 100px;
}

.info-order__info {
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.82;
}

.info-order_addres {
    color: var(--yellow);

}

.info-order__info--promocode {
    color: var(--pink);
    font-size: 20px;
    font-family: "Montserrat-SemiBold", sans-serif;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.82;
}
</style>