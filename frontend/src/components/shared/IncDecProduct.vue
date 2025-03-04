<script setup lang="ts">
import { useBacketStore } from '@/stores/backet';

const {
    id,
    count,

} = defineProps<{
    id: number,
    count: number,
}>();

const store = useBacketStore()

const { incrementCount, decrementCount } = store
</script>
<template>
    <div class="product-btn--container">
        <button class="btn--text" @click="decrementCount(id)">-</button>
        <p class="btn--text">{{ count }}</p>
        <button class="btn--text" @click="incrementCount(id)">+</button>
    </div>
</template>
<style scoped>
.product-btn--container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;

    border-radius: 8px;
    background: var(--gray-light);
    padding: 8px 15px;

    max-width: 93px;
    max-height: 32px;
}

.btn--text {
    color: var(--gray);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
}
</style>