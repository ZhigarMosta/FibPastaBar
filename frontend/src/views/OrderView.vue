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

const storeUser = useUserStore();
const { user } = storeToRefs(storeUser);

const storeBacket = useBacketStore();
const { delivery, deliveryTime, costOrder, discountOrder } = storeToRefs(storeBacket);

const changeAddres = useTemplateRef('addres')

const orderDelivery = () => {
    changeAddres.value?.StateToAddres
    changeAddres.value?.OpenModal()
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
                <RouteTo text="Назад в корзину" url="/backet" />
                <Btn @click="orderDelivery" view="addres-or-order">
                    <ContentBtn view="content-type--apply-order">
                        <template v-slot:count>{{ costOrder - (costOrder * discountOrder * 0.01) }}</template>
                        <template v-slot:text>Оформить заказ на</template>
                    </ContentBtn>
                </Btn>
            </div>
        </div>
        <div class="right-side--container">
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
    max-width: 337px;
}

.order-view--container {
    width: 100%;
    max-width: 1110px;
    padding: 0 10px;
    margin: 0 auto;

    display: flex;
}
</style>