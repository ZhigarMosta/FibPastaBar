<script setup lang="ts">
import OrderItem from '@/components/shared/OrderItem.vue';
import PageTitle from '@/components/shared/PageTitle.vue';
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';
import { onMounted, ref } from 'vue';
interface Order {
  id: number,
  addres_sity: string,
  addres_house: string,
  addres_name_addres: string,
  cost: number,
  buyer_name: string,
  buyer_email: string,
  created_at: string
}
interface OrdersInterface {
  orders: Order[]
}

const store = useUserStore();
const { user } = storeToRefs(store);

const orderList = ref<OrdersInterface | undefined>(undefined)

onMounted(async () => {
  const response = await fetch(`http://api.local/api/order/list_by_user_id/${user.value.id}`, {
    method: "GET",
    mode: 'cors'
  });
  const data = await response.json();
  orderList.value = data
  console.log(data.orders)
})
console.log(orderList.value)
</script>
<template>
  <div class="orders">
    <PageTitle>Ваши заказы</PageTitle>
    <OrderItem v-if="orderList" v-for="item of orderList.orders" :addres_house="item.addres_house"
      :addres_name_addres="item.addres_name_addres" :addres_sity="item.addres_sity" :buyer_email="item.buyer_email"
      :buyer_name="item.buyer_name" :cost="item.cost" :created_at="item.created_at" :id="item.id" />
  </div>
</template>
<style scoped>
.orders {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 20px;
  margin-top: 100px;
}
</style>
