<script setup lang="ts">
import { RouterLink } from 'vue-router';
const {
    text,
    url
} = defineProps<{
    text: string,
    url: string
}>();
</script>
<template>
    <RouterLink class="btn-route-to" :to="url"><img class="btn-back--arrow" src="../../assets/img/svg/back.svg" alt="arrow">
        <p class="btn-back--text">{{ text }}</p>
    </RouterLink>
</template>
<style scoped>
.btn-route-to {
    display: flex;
    justify-content: space-between;

    width: 100%;
    max-width: 200px;
}

.btn-back--arrow {
    width: 10px;
    height: 28px;
}

.btn-back--text {
    color: var(--gray);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}
</style>