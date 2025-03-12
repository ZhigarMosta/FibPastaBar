<script setup lang="ts">
import OrderСompositionList from "@/components/features/OrderСompositionList.vue"
import type { BacketInterface } from "@/stores/backet";

const {
    backet,
    costOrder,
    discountOrder,
    totalCostOrder,
} = defineProps<{
    backet: BacketInterface[],
    costOrder: number
    discountOrder?: number
    totalCostOrder: number
}>();

</script>
<template>
    <div class="order-composition">
        <p class="order-composition__title">Состов заказа</p>
        <OrderСompositionList :backet="backet" class="order-composition-list" />
        <div class="order-composition__cost-order--container">
            <p class="order-composition__cost-order-title">Сумма заказа</p>
            <div class="order-composition__price">
                <p class="order-composition__cost-order-price--default"
                    :class="{ 'order-composition__cost-order-price--crossed': discountOrder && discountOrder > 0 }">
                    {{ costOrder }} ₽
                </p>
                <p class="order-composition__cost-order-price-discount" v-if="discountOrder && discountOrder > 0">
                    {{ totalCostOrder }} ₽
                </p>
            </div>
        </div>
        <p class="order-composition__delivery">Беспалтная доставка</p>
    </div>
</template>
<style scoped>
.order-composition__cost-order-price-discount {
    color: var(--pink);
    text-align: right;
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
}

.order-composition__price {
    display: flex;
    gap: 5px;
}

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

.order-composition__cost-order-price--default {
    color: var(--black);
    font-family: "Montserrat-ExtraBold", sans-serif;
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

.order-composition__cost-order-price--crossed {
    text-decoration-line: line-through;
    text-decoration-color: var(--yellow);
    text-decoration-thickness: 2px;
    font-size: 14px;
}
</style>