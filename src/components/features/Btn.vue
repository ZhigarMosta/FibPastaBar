<script setup lang="ts">
import { onMounted, ref } from 'vue';

const {
    view,
} = defineProps<{
    view: "btn-type--pizza" | "btn-type--basket" | "btn-type--stock" | "btn-type--addres-and-order" | "btn-type--send" | "btn-type--look" | "btn-type--call" | "btn-type--footer";
}>();

const styleText = ref("");
switch (view) {
    case 'btn-type--pizza':
        styleText.value = "btn-pizza-and-stock--text"
        break;
    case "btn-type--basket":
        styleText.value = "btn-basket--text"
        break;
    case "btn-type--stock":
        styleText.value = "btn-pizza-and-stock--text"
        break;
    case "btn-type--send":
        styleText.value = "btn-send--text"
        break;
    case "btn-type--addres-and-order":
        styleText.value = "btn-addres-and-order--text"
        break;
    case "btn-type--footer":
        styleText.value = "btn-footer--text"
        break;
    case "btn-type--call":
        styleText.value = "btn-call--text"
        break;
    case "btn-type--look":
        styleText.value = "btn-look--text"
        break;
}
</script>
<template>
    <button :class="view" class="container">
        <div :class="styleText">
            <slot></slot>
        </div>
    </button>
</template>

<style>
@font-face {
    font-family: "Montserrat-Bold";
    src: url("../../assets/fonts/Montserrat-Bold.ttf") format("ttf");
}

@font-face {
    font-family: "Montserrat-ExtraBold";
    src: url("../../assets/fonts/Montserrat-ExtraBold.ttf") format("ttf");
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.btn-type--pizza {
    width: 123px;
    height: 36px;
    border-radius: 8px;
    background-color: var(--yellow);
}

.btn-pizza-and-stock--text {
    color: var(--white);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

.btn-type--pizza:hover .btn-pizza-and-stock--text {
    color: var(--gray-dark);
}

.btn-type--basket {
    width: 160px;
    height: 42px;
    border-radius: 8px;
    background-color: var(--yellow);

}

.btn-type--basket:hover .btn-basket--text div p {
    color: var(--white);
}

.btn-type--basket:hover .btn-basket--text div p+div {
    background-color: var(--white);
}

.btn-type--stock {
    width: 160.0px;
    height: 48.0px;
    border-radius: 23px;

    background-color: var(--yellow);
}

.btn-type--stock:hover .btn-pizza-and-stock--text {
    color: var(--gray-dark);
}

.btn-type--addres-and-order {
    height: 55px;
    border-radius: 8px;

    background-color: var(--yellow);
}

.btn-addres-and-order--text {
    color: var(--black);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;

    margin: 0 25px 0 25px;
    transition: color 0.3s ease-in-out;
}

.btn-type--addres-and-order:hover .btn-addres-and-order--text {
    color: var(--white);
}

.btn-type--addres-and-order:hover .btn-addres-and-order--text div p {
    color: var(--white);
}

.btn-type--send {
    width: 176px;
    height: 52px;
    border-radius: 8px;
    background-color: var(--yellow);
}

.btn-send--text {
    color: #231F20;
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

.btn-type--send:hover .btn-send--text {
    color: var(--white);
}

.btn-footer--text {
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    opacity: 0.8;
    color: var(--light-black);
}

.btn-type--footer {
    height: 52px;
    border-radius: 13px;
    border: 2px solid var(--light-blue);
}

.btn-look--text {
    color: var(--gray-dark);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

.btn-type--look {
    width: 159px;
    height: 45px;
    border-radius: 8px;
    background-color: var(--yellow);
}

.btn-type--look:hover .btn-look--text {
    color: var(--white);
}

.btn-call--text {
    color: var(--gray);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;

    transition: color 0.3s ease-in-out;
}

.btn-type--call {
    width: 180px;
    height: 42px;
    border-radius: 28px;
    background: var(--gray-light);
}

.btn-type--call:hover .btn-call--text {
    color: var(--black);
}
</style>
