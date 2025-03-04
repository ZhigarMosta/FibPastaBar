<script setup lang="ts">
const {
    text,
} = defineProps<{
    text: string,
}>();
import errorImg from "@/assets/img/png/Error.png"
</script>
<template>
    <div class="message--container">
        <div class="message--arrow"></div>
        <img :src="errorImg" alt="error">
        <p class="message--text">{{ text }}</p>
    </div>
</template>
<style scoped>
.message--container {
    display: flex;
    gap: 12px;
    justify-content: space-between;
    align-items: center;

    padding: 7px 19px 7px 13px;
    background-color: var(--pink);
    border-radius: 8px;
    margin-top: 7px;
}

.message--arrow {
    transform: rotate(45deg);
    z-index: 1;
    border-radius: 2px;
    background-color: var(--pink);
    position: absolute;
    margin-bottom: 40px;
    margin-left: 4px;
    width: 10px;
    height: 10px;
}

.message--text {
    color: var(--white);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 12px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}
</style>