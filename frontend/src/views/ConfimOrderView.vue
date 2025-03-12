<script setup lang="ts">
import Btn from '@/components/features/Btn.vue';
import ChangeAddres from '@/components/features/ChangeAddres.vue';
import Bonus from '@/components/shared/Bonus.vue';
import ContentBtn from '@/components/shared/ContentBtn.vue';
import PageTitle from '@/components/shared/PageTitle.vue';
import PaymentMethods from '@/components/shared/PaymentMethods.vue';
import PromotionalCode from '@/components/shared/PromotionalCode.vue';
import RouteTo from '@/components/shared/RouteTo.vue';
import { useBacketStore } from '@/stores/backet';
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';
import { useTemplateRef } from 'vue';
import OrderСomposition from "@/components/widgets/OrderСomposition.vue"
import router from '@/router';
import { useOrderStore } from '@/stores/order';

const clearBacketStore = () => {
    backet.value = [...[]];
    countProductInBacket.value = 0
    costOrder.value = 0
    discountOrder.value = 0
    promotionalCode.value = ""
}
const storeOrder = useOrderStore();
const { order } = storeToRefs(storeOrder);

const storeUser = useUserStore();
const { user } = storeToRefs(storeUser);

const storeBacket = useBacketStore();
const { delivery, backet, deliveryTime, costOrder, discountOrder, promotionalCode, countProductInBacket } = storeToRefs(storeBacket);

const changeAddres = useTemplateRef('addres')

const orderDelivery = async () => {
    if (!deliveryTime) {
        changeAddres.value?.onEditModalState(changeAddres.value?.ModalStateEnum.Time)
        return
    }
    if (!delivery.value.addres.sity && !delivery.value.addres.house && !delivery.value.addres.apartment && !delivery.value.addres.floor && !delivery.value.addres.entrance) {
        changeAddres.value?.onEditModalState(changeAddres.value?.ModalStateEnum.Address)
        return
    }
    if (!user.value.name) {
        changeAddres.value?.onEditModalState(changeAddres.value?.ModalStateEnum.Name)
        return
    }
    if (!user.value.email) {
        changeAddres.value?.onEditModalState(changeAddres.value?.ModalStateEnum.Email)
        return
    }
    const response = await fetch('http://api.local/api/order', {
        method: "POST",
        body: JSON.stringify({ delivery: delivery.value, user: user.value, promotionalCode: promotionalCode.value, deliveryTime: deliveryTime.value, backet: backet.value }),
        mode: 'cors'
    });

    const data = await response.json();

    order.value = data
    console.log(data)

    clearBacketStore()

    router.push({
        path: '/order',
    })
}

</script>
<template>
    <div class="order-view--container">
        <div class="left-side--container">
            <PageTitle>Заказ на доставку</PageTitle>
            <ChangeAddres ref="addres" />
            <div class="promotional--container">
                <p class="promotional--text">Промокод</p>
                <PromotionalCode />
            </div>
            <PaymentMethods />
            <Bonus />
            <div class="order-btn--container">
                <RouteTo class="order-view__rout-to" text="Назад в корзину" url="/backet" />
                <Btn @click="orderDelivery" view="addres-or-order">
                    <ContentBtn view="content-type--apply-order">
                        <template v-slot:count>{{ costOrder - (costOrder * discountOrder * 0.01) }}</template>
                        <template v-slot:text>Оформить заказ на</template>
                    </ContentBtn>
                </Btn>
            </div>
        </div>
        <div class="right-side--container">
            <OrderСomposition :backet="backet" :costOrder="costOrder"
                :totalCostOrder="costOrder - (costOrder * discountOrder * 0.01)" :discountOrder="discountOrder" />
        </div>
    </div>
</template>
<style scoped>
.order-btn--container {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin: 51px 0 85px 0;
}

.promotional--container {
    display: flex;
    flex-direction: column;
    gap: 27px;
    margin-top: 40px;
}

.promotional--text {
    color: var(--yellow);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 22px;
    font-style: normal;
    font-weight: 600;
    line-height: 17px;
}

.left-side--container {
    width: 100%;
    max-width: 730px;
}

.right-side--container {
    width: 100%;
    margin-top: 128px;
    max-width: 337px;
}

.order-view--container {
    width: 100%;
    max-width: 1110px;
    padding: 0 10px;
    margin: 0 auto;

    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 44px;
}

@media (max-width:1110px) {
    .left-side--container {
        margin: 0 auto;
    }

    .right-side--container {
        margin: 0 auto;
    }

    .order-btn--container {
        flex-direction: column;
        justify-content: center;
        gap: 14px;
    }

    .order-view__rout-to {
        order: 2;
    }
}
</style>