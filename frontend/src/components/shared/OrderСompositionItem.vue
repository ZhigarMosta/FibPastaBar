<script setup lang="ts">
const {
    name,
    price,
    totalPrice,
    description

} = defineProps<{
    name: string,
    price: number,
    totalPrice: number,
    description: string
}>();
</script>
<template>
    <div class="order-composition-item">
        <div class="order-composition-item__text-container">
            <p class="order-composition-item__name">{{ name }} за {{ price }} ₽</p>
            <p class="order-composition-item__description">{{ description }}</p>
        </div>
        <p class="order-composition-item__price">{{ totalPrice }}₽</p>
    </div>
</template>
<style scoped>
.order-composition-item {
    display: flex;
    justify-content: space-between;
    align-items: start;

    width: 100%;
    max-width: 293px;
}

.order-composition-item__text-container {
    display: flex;
    flex-direction: column;
}

.order-composition-item__name {
    color: var(--v3-light-black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
}

.order-composition-item__description {
    color: var(--v3-light-black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 11px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
    opacity: 0.6;
}

.order-composition-item__price {
    color: var(--black);
    text-align: right;
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}
</style>