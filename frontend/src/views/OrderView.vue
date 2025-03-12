<script setup lang="ts">
import GratitudeOrder from '@/components/features/GratitudeOrder.vue';
import InfoOrder from '@/components/features/InfoOrder.vue';
import PageTitle from '@/components/shared/PageTitle.vue';
import OrderСomposition from "@/components/widgets/OrderСomposition.vue"
import { useBacketStore } from '@/stores/backet';
import { useOrderStore } from '@/stores/order';
import { storeToRefs } from 'pinia';

const store = useOrderStore();
const { order } = storeToRefs(store);

const BacketStore = useBacketStore();
const { backet, countProductInBacket, costOrder, discountOrder, promotionalCode } = storeToRefs(BacketStore);

const clearBacketStore = () => {
  backet.value = [...[]];
  countProductInBacket.value = 0
  costOrder.value = 0
  discountOrder.value = 0
  promotionalCode.value = ""
}
console.log(order.value)

</script>
<template>
  <div class="order" v-if="order">
    <div class="order__left-side">
      <PageTitle>Ваш заказ</PageTitle>
      <GratitudeOrder :clearBacketStore="clearBacketStore" :date="order?.order.created_at" :id="order?.order.id" />
      <InfoOrder :clearBacketStore="clearBacketStore" />
    </div>
    <div class="order__right-side">
      <OrderСomposition v-if="order.promotional_code" :backet="order.products"
        :costOrder="order.order.cost / (1 - order.promotional_code.discount_percentage * 0.01)"
        :totalCostOrder="order.order.cost" :discountOrder="order.promotional_code.discount_percentage" />
      <OrderСomposition v-else :backet="order.products" :costOrder="order.order.cost"
        :totalCostOrder="order.order.cost" />
    </div>
  </div>
</template>
<style>
.order__right-side {
  margin-top: 128px;
}

.order {
  width: 100%;
  max-width: 1110px;
  padding: 0 10px;
  margin: 0 auto;
  margin-bottom: 50px;

  display: flex;
  /* flex-direction: column; */
  justify-content: space-between;
}

.order__left-side {
  width: 100%;
  max-width: 500px;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.order__right-side {
  width: 337px;
}
</style>