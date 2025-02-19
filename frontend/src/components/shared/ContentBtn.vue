<script setup lang="ts">
import { ref } from 'vue';
const {
    view = "default",
} = defineProps<{
    view?: "content-type--basket" | "content-type--apply-order";
}>();

</script>

<template>
    <div class="container--basket" v-if="view === 'content-type--basket'">
        <p class="text--basket">
            <slot name="text"></slot>
        </p>
        <div class="line"></div>
        <p class="text--basket">
            <slot name="count"></slot>
        </p>
    </div>
    <div class="container--apply-order" v-else-if="view === 'content-type--apply-order'">
        <p class="text--apply-order">
            <slot name="text"></slot>
        </p>
        &nbsp;
        <p class="text--apply-order">
            <slot name="count"></slot>
        </p>
        <img class="arrow" src="../../assets/img/svg/ArrowApplyOrder.svg" alt="arrow">
    </div>
    <div v-else>
        <slot></slot>
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

.container--basket {
    width: 111px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.text--basket {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

.line {
    width: 2px;
    height: 23px;
    border-radius: 5px;

    flex-shrink: 0;
    border-radius: 5px;
    background: var(--black);
    transition: background 0.3s ease-in-out;
}

.arrow {
    margin-left: 14px;
}

.container--apply-order {
    padding: 0 0 0 19px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.text--apply-order {
    color: var(--black);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}
</style>
