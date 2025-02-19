<script setup lang="ts">
import ContentBtn from '../shared/ContentBtn.vue';
import Btn from './Btn.vue';
const {
    isNew,
    img,
    productName,
    desc,
    price

} = defineProps<{
    isNew: boolean,
    img: string,
    productName: string,
    desc: string,
    price: number
}>();

</script>

<template>
    <div class="product-card--container">
        <div v-if="isNew" class="new">
            NEW
        </div>
        <img class="product-card---img" :src="img" alt="product">
        <p class="product-card--name">{{ productName }}</p>
        <p class="product-card--desc">{{ desc }}</p>
        <div class="product-card--price-container">
            <p class="product-card--price">от {{ price }} ₽</p>
            <div class="product-card--btn-container">
                <Btn view="pizza">
                    <ContentBtn>В Корзину</ContentBtn>
                </Btn>
            </div>

        </div>
    </div>
</template>

<style scoped>
@font-face {
    font-family: "Montserrat-Bold";
    src: url("../../assets/fonts/Montserrat-Bold.ttf") format("ttf");
}

@font-face {
    font-family: "Montserrat-ExtraBold";
    src: url("../../assets/fonts/Montserrat-ExtraBold.ttf") format("ttf");
}

@font-face {
    font-family: "Montserrat-Medium";
    src: url("../../assets/fonts/Montserrat-Medium.ttf") format("ttf");
}

.product-card--container {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 256px;
}

.new {
    position: absolute;
    background-color: var(--red);
    border-radius: 25px;
    padding: 4px 16px;

    color: var(--white);
    margin: 0 0 390px 180px;
}

.product-card---img {
    width: 253px;
    height: 253px;

    margin-bottom: 8px;
}

.product-card--price-container {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.product-card--name {
    color: var(--v1-gray-little-dark);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 24px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;

    margin-bottom: 14px;
}

.product-card--desc {
    color: var(--v2-gray-little-dark);
    font-family: "Montserrat-Medium", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 500;
    line-height: 19px;

    margin-bottom: 25px;
}

.product-card--price {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 22px;
    font-style: normal;
    font-weight: 700;
    line-height: 19px;
}

.product-card--btn-container {
    width: 123px;
}
</style>