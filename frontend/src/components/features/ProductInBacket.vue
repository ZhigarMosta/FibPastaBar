<script setup lang="ts">
import IncDecProduct from "../shared/IncDecProduct.vue";
import DeleteProduct from "../shared/DeleteProduct.vue";
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

</script>
<template>
    <div class="product-in-backet--container">
        <div class="product-left-block--container">
            <img class="product--img" :src="img" alt="product">
            <div class="product-name-and-btn--container">
                <p class="product-name">{{ productName }}</p>
                <IncDecProduct :count="count" :id="id" />
            </div>
        </div>
        <div class="delite-product-and-product-price--container">
            <DeleteProduct :id="id" />
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

.product-name {
    color: var(--light-black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 17px;
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