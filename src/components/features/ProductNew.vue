<script setup lang="ts">
const {
    img,
    ProductName,
    price,

} = defineProps<{
    img: string,
    ProductName: string,
    price: number,
}>();
</script>

<template>
    <button class="new--container">
        <img class="new--img" :src="img" alt="pizza">
        <div class="new--product-container">
            <p class="product--name">{{ ProductName }}</p>
            <p class="product--price">от {{ price }} ₽</p>
        </div>
    </button>
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

.product-card--container {
    width: 255px;
    height: 99px;
    border-radius: 12px;
    background: #FFF;
    box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.06);

    display: flex;
    align-items: center;
    justify-content: start;
    gap: 25px;

    padding-left: 17px;
}

.new--product-container {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.product-card---img {
    width: 71.0px;
    height: 71.0px;
}

.product-card--name {
    color: var(--black-default);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
}

.product-card--price {
    color: var(--yellow);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
}
</style>