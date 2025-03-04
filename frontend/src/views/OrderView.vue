<script setup lang="ts">
import PageTitle from '@/components/shared/PageTitle.vue';

</script>
<template>
    <div class="order-view--container">
        <div class="left-side--container">
            <PageTitle>Заказ на доставку</PageTitle>
        </div>
        <div class="right-side--container"></div>
    </div>
</template>
<style scoped>
.order-view--container {
    width: 100%;
    max-width: 1110px;

    padding: 0 10px;
    margin: 0 auto;

    display: flex;
}

.left-side--container {
    width: 100%;
    max-width: 730px;
}

.right-side--container {
    width: 100%;
    max-width: 337px;
}
</style>