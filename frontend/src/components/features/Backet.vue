<script setup lang="ts">
import { useBacketStore } from '@/stores/backet';
import ProductInBacket from '../shared/ProductInBacket.vue';
import { storeToRefs } from 'pinia';
const store = useBacketStore()

const { backet } = storeToRefs(store)


</script>
<template>
    <div class="backet-list--container">
        <div class="backet-list">
            <ProductInBacket v-for="product of backet" :count="product.count" :img="product.img" :price="product.price"
                :product-name="product.name" :id="product.id" />
        </div>
    </div>
</template>
<style scoped>
.backet-list--container {
    width: 350px;
    padding-top: 15px;
    position: absolute;
    margin-left: -175px;
}

.backet-list {
    width: 350px;
    position: absolute;
    border-radius: 10px;
    border: 3.5px solid rgba(247, 210, 45, 0.40);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    padding: 24px;
    background-color: var(--white);
}
</style>