<script setup lang="ts">
import ContentBtn from '../shared/ContentBtn.vue';
import Btn from './Btn.vue';
const {
    isNew,
    img,
    namePizza,
    dec,
    price

} = defineProps<{
    isNew: boolean,
    img: string,
    namePizza: string,
    dec: string,
    price: number
}>();

</script>

<template>
    <div class="container">
        <div v-if="isNew" class="new">
            NEW
        </div>
        <img class="img" :src="img" alt="pizza">
        <p class="name-pizza">{{ namePizza }}</p>
        <p class="dec-pizza">{{ dec }}</p>
        <div class="price--container">
            <p class="price">от {{ price }} ₽</p>
            <div class="container--btn">
                <Btn view="btn-type--pizza">
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

.container {
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

.img {
    width: 253px;
    height: 253px;

    margin-bottom: 8px;
}

.price--container {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.name-pizza {
    color: var(--v1-gray-little-dark);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 24px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;

    margin-bottom: 14px;
}

.dec-pizza {
    color: var(--v2-gray-little-dark);
    font-family: "Montserrat-Medium", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 500;
    line-height: 19px;

    margin-bottom: 25px;
}

.price {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 22px;
    font-style: normal;
    font-weight: 700;
    line-height: 19px;
}

.container--btn {
    width: 123px;
}
</style>