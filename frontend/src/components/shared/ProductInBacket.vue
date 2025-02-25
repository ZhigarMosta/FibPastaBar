<script setup lang="ts">
import deleteProductFrombacket from "@/assets/img/png/deleteProductFrombacket.png"
import { useBacketStore } from "@/stores/backet";
const {
    img,
    productName,
    price,
    id,
    count

} = defineProps<{
    id: number
    img: string,
    productName: string,
    price: number,
    count: number
}>();

const store = useBacketStore()

const { deleteProduct, incrementCount, decrementCount } = store

</script>
<template>
    <div class="product-in-backet--container">
        <div class="product-left-block--container">
            <img class="product--img" :src="img" alt="product">
            <div class="product-name-and-btn--container">
                <p class="product-name">{{ productName }}</p>
                <div class="product-btn--container">
                    <button class="btn--text" @click="decrementCount(id)">-</button>
                    <p class="btn--text">{{ count }}</p>
                    <button class="btn--text" @click="incrementCount(id)">+</button>
                </div>
            </div>
        </div>
        <div class="delite-product-and-product-price--container">
            <button @click="deleteProduct(id)" class="btn--delite-product"><img :src="deleteProductFrombacket" alt="close"></button>
            <p class="product-price">{{ price }} ₽</p>
        </div>
    </div>
    <div class="product--line-bottom"></div>
</template>
<style scoped>
.product-in-backet--container {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.product-left-block--container {
    display: flex;
    gap: 17px;
}

.product-name-and-btn--container {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.product-btn--container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;

    border-radius: 8px;
    background: var(--gray-light);
    padding: 8px 15px;
}

.delite-product-and-product-price--container {
    display: flex;
    flex-direction: column;
    align-items: end;
    gap: 22px;
}

.product--img {
    width: 70px;
    height: 70px;
}

.btn--delite-product {
    width: 27px;
    height: 27px;
}

.product-name {
    color: var(--light-black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 17px;
}

.btn--text {
    color: var(--gray);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
}

.product-price {
    color: var(--yellow);
    text-align: center;
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
}

.product--line-bottom {
    background: var(--v3-gray-little-dark);
    width: 100%;
    min-height: 2px;
}
</style>