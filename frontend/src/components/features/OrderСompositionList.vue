<script setup lang="ts">
import OrderСompositionItem from "@/components/shared/OrderСompositionItem.vue"
import { useBacketStore, type BacketInterface } from "@/stores/backet";

const {
    backet,
} = defineProps<{
    backet: BacketInterface[],
}>();
</script>
<template>
    <div class="order-composition-list">
        <OrderСompositionItem v-for="item of backet" :name="item.name" :price="item.price"
            :totalPrice="item.price * item.count" :description="item.descroption" />
    </div>
</template>
<style scoped>
.order-composition-list {
    display: flex;
    flex-direction: column;

    gap: 21px;
    height: 100%;
    max-height: 267px;
    overflow-y: scroll;
}
</style>