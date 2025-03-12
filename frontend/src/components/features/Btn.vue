<script setup lang="ts">
import { ref } from 'vue';

const {
    view,
    fn
} = defineProps<{
    view: "pizza" | "stock" | "addres-or-order" | "send" | "look" | "call" | "footer";
    fn?: () => void
}>();
const styleBtn = ref(`${view}--btn`)
const styleText = ref(`${view}--text`);

</script>
<template>
    <button @click="fn" :class="styleBtn" class="container">
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
    z-index: 2;
}

.pizza--btn {
    width: 123px;
    height: 36px;
    border-radius: 8px;
    background-color: var(--yellow);
}

.pizza--text {
    color: var(--white);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

.pizza--btn:hover .pizza--text {
    color: var(--gray-dark);
}

.stock--btn {
    width: 160.0px;
    height: 48.0px;
    border-radius: 23px;

    background-color: var(--yellow);
}

.stock--btn:hover .pizza--text {
    color: var(--gray-dark);
}

.addres-or-order--btn {
    height: 55px;
    border-radius: 8px;

    background-color: var(--yellow);
}

.addres-or-order--text {
    color: var(--black);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;

    margin: 0 25px 0 25px;
    transition: color 0.3s ease-in-out;
}

.addres-or-order--btn:hover .addres-or-order--text {
    color: var(--white);
}

.addres-or-order--btn:hover .addres-or-order--text div p {
    color: var(--white);
}

.send--btn {
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

.send--btn:hover .btn-send--text {
    color: var(--white);
}

.footer--text {
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    opacity: 0.8;
    color: var(--light-black);
}

.footer--btn {
    height: 52px;
    border-radius: 13px;
    border: 2px solid var(--light-blue);
    transition: border 0.3s ease-in-out;
}

.footer--btn:hover {
    height: 52px;
    border-radius: 13px;
    border: 2px solid var(--yellow);
}


.look--text {
    color: var(--gray-dark);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

.look--btn {
    width: 159px;
    height: 45px;
    border-radius: 8px;
    background-color: var(--yellow);
}

.look--btn:hover .look--text {
    color: var(--white);
}

.call--text {
    color: var(--gray);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;

    transition: color 0.3s ease-in-out;
}

.call--btn {
    width: 180px;
    height: 42px;
    border-radius: 28px;
    background: var(--gray-light);
}

.call--btn:hover .call--text {
    color: var(--black);
}

@media (max-width:768px) {
    .call--btn {
        width: 131px;
        height: 32px;
    }

    .call--text {
        font-size: 11px;
    }
}
</style>
