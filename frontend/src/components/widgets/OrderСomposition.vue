<script setup lang="ts">
import { useBacketStore } from "@/stores/backet";
import { storeToRefs } from "pinia";
import OrderСompositionList from "@/components/features/OrderСompositionList.vue"
const store = useBacketStore()

const { costOrder } = storeToRefs(store)

</script>
<template>
    <div class="order-composition">
        <p class="order-composition__title">Состов заказа</p>
        <OrderСompositionList class="order-composition-list" />
        <div class="order-composition__cost-order--container">
            <p class="order-composition__cost-order-title">Сумма заказа</p>
            <p class="order-composition__cost-order-price">{{ costOrder }} ₽</p>
        </div>
        <p class="order-composition__delivery">Беспалтная доставка</p>
    </div>
</template>
<style scoped>
.order-composition {
    width: 100%;
    max-width: 508px;
    background: var(--white);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    padding: 21px 0 24px 22px;
}

.order-composition__title {
    color: var(--yellow);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;
}

.order-composition-list {
    margin-top: 23px;
}

.order-composition__cost-order--container {
    margin-top: 23px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-right: 22px;
}

.order-composition__cost-order-title {
    color: var(--v9-gray-little-dark);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
}

.order-composition__cost-order-price {
    color: var(--black);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;
}

.order-composition__delivery {
    margin-top: 19px;
    color: var(--v2-light-black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.6;
    text-align: center;
}
</style>