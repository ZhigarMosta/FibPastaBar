<script setup lang="ts">
import { useBacketStore } from '@/stores/backet';
import deleteProductFrombacket from "@/assets/img/png/deleteProductFrombacket.png"
const {
    id,

} = defineProps<{
    id: number,
}>();
const store = useBacketStore()
const { deleteProduct } = store
</script>
<template>
    <button @click="deleteProduct(id)" class="btn--delite-product"><img :src="deleteProductFrombacket"
            alt="close"></button>
</template>
<style scoped>
.btn--delite-product {
    width: 27px;
    height: 27px;
}
</style>