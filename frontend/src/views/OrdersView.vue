<script setup lang="ts">
import OrderItem from '@/components/shared/OrderItem.vue';
import PageTitle from '@/components/shared/PageTitle.vue';
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';
import { onMounted, ref, watchEffect } from 'vue';
interface Order {
  id: number,
  addres_sity: string,
  addres_house: string,
  addres_name_addres: string,
  cost: number,
  buyer_name: string,
  buyer_email: string,
  created_at: string,
  status: string
}
interface OrdersInterface {
  orders: {
    items: Order[], total_items: number,
    limit: number,
    first: number,
    previous: number,
    current: number,
    next: number,
    last: number
  },

}

const store = useUserStore();
const { user } = storeToRefs(store);

const orderList = ref<OrdersInterface | undefined>(undefined)
const currentPage = ref<number>(1);
const orderId = ref<number | undefined>(undefined)
const orderStatus = ref<string>("Все")

const paginatorNext = () => {
  currentPage.value++
  console.log(currentPage.value)
}
const paginatorPrevious = () => {
  currentPage.value--
  console.log(currentPage.value)
}
watchEffect(async () => {
  const response = await fetch(`http://api.local/api/order/list_by_user_id`, {
    method: "POST",
    mode: 'cors',
    body: JSON.stringify({ userId: user.value.id, orderId: orderId.value, orderStatus: orderStatus.value, currentPage: currentPage.value }),
  });
  const data = await response.json();
  orderList.value = data
  console.log(data)
});

onMounted(async () => {
  const response = await fetch(`http://api.local/api/order/list_by_user_id`, {
    method: "POST",
    mode: 'cors',
    body: JSON.stringify({ userId: user.value.id, orderId: orderId.value, orderStatus: orderStatus.value, currentPage: currentPage.value }),
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
    <div class="">
      <input v-model="orderId" placeholder="номер заказа" />

      <select v-model="orderStatus" name="statusOrder">
        <option id="statusOrder" value="Создан">Все</option>
        <option id="statusOrder" value="Создан">Создан</option>
        <option id="statusOrder" value="Готовится">Готовится</option>
        <option id="statusOrder" value="Доставка">Доставка</option>
        <option id="statusOrder" value="Завершен">Завершен</option>
        <option id="statusOrder" value="Отменен">Отменен</option>
      </select>

    </div>
    <OrderItem v-if="orderList" v-for="item of orderList.orders.items" :addres_house="item.addres_house"
      :addres_name_addres="item.addres_name_addres" :addres_sity="item.addres_sity" :buyer_email="item.buyer_email"
      :buyer_name="item.buyer_name" :cost="item.cost" :created_at="item.created_at" :id="item.id"
      :status="item.status" />
    <div class="orders__pagination-btn" v-if="orderList?.orders.items">
      <div v-if="orderList?.orders.previous != orderList?.orders.current" class="orders__pagination-btn--container">
        <button @click="paginatorPrevious()" class="test">{{ orderList?.orders.previous }}</button>
        <p>Предыдущая</p>
      </div>
      <div class="orders__pagination-btn--container">
        <button class="test">{{ orderList?.orders.current }}</button>
        <p>Текущая</p>
      </div>
      <div v-if="orderList?.orders.next != orderList?.orders.current" class="orders__pagination-btn--container">
        <button @click="paginatorNext()" class="test">{{ orderList?.orders.next }}</button>
        <p>Следующая</p>
      </div>
    </div>
  </div>
</template>
<style scoped>
.orders__pagination-btn--container {
  display: flex;
  gap: 5px;
  align-items: center;
  flex-direction: column;
}

.test {
  width: 20px;
  height: 20px;
  background-color: var(--yellow);
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.orders__pagination-btn {
  display: flex;
  gap: 5px;
}

.orders {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 20px;
  margin-top: 100px;
}
</style>
