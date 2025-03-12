<script setup lang="ts">
import router from '@/router';
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';
import Btn from './Btn.vue';

const {
    id,
    date,
} = defineProps<{
    id: number,
    date: string,
    clearBacketStore(): void
}>();


const store = useUserStore();
const { user } = storeToRefs(store);

const redirectToOrders = () => {
    router.push({
        path: '/orders',
    })
}

</script>
<template>
    <div class="gratitude">
        <p class="gratitude__text">Спасибо за ваш заказ!</p>
        <p class="gratitude__info-order">Номер заказа <span class="gratitude__order-id">{{ id }}</span> от <span
                class="gratitude__order-date">{{ date }}</span></p>
        <Btn :fn="redirectToOrders" class="gratitude__btn" v-if="user.id" view="look">В мои заказы</Btn>
    </div>
</template>
<style scoped>
.gratitude__btn {
    margin: 0 auto;
    margin-top: 20px;
}

.gratitude {
    background: var(--white);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 400px;
    padding: 20px;
}

.gratitude__text {
    color: var(--v3-light-black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
    margin-bottom: 20px;
}

.gratitude__info-order {
    color: var(--v3-light-black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
}

.gratitude__order-id,
.gratitude__order-date {
    color: var(--yellow);
}
</style>