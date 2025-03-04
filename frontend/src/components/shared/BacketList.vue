<script setup lang="ts">
import { useBacketStore } from '@/stores/backet';
import { storeToRefs } from 'pinia';
import BacketItem from '../features/BacketItem.vue';

const store = useBacketStore();
const { backet } = storeToRefs(store);
</script>
<template>
    <BacketItem v-for="product of backet" :key="product.id" :id="product.id" :count="product.count"
        :description="product.descroption" :img="product.img" :name="product.name" :price="product.price" />
</template>
<style scoped></style>