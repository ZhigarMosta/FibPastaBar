<script setup lang="ts">
import BacketList from '@/components/shared/BacketList.vue';
import PageTitle from '@/components/shared/PageTitle.vue';
import PromotionalCode from '@/components/shared/PromotionalCode.vue';
import RouteTo from '@/components/shared/RouteTo.vue';
import { useBacketStore } from '@/stores/backet';
import { storeToRefs } from 'pinia';
import { RouterLink } from 'vue-router';

const store = useBacketStore()
const { costOrder, discountOrder } = storeToRefs(store)
</script>
<template>
    <div class="backet-view--container">
        <PageTitle>Корзина</PageTitle>
        <BacketList />
        <div class="promotional-and-order---container">
            <div class="promotional-and-price--container">
                <div class="promotional--container">
                    <p class="promotional--text">Промокод</p>
                    <PromotionalCode />
                </div>
                <div class="order---container">
                    <p class="order--text">Сумма заказа:</p>
                    <div class="order-price--container">
                        <p class="order--price" :class="{ 'order--discount': discountOrder > 0 }">
                            {{ costOrder }} ₽
                        </p>
                        <p class="order--price-discount" v-if="discountOrder > 0">
                            {{ costOrder - (costOrder * discountOrder * 0.01) }} ₽
                        </p>
                    </div>
                </div>
            </div>
            <div class="btn--container">
                <RouteTo class="btn-back" text="Вернуться в магазин" url="/" />
                <RouterLink class="btn--order" to="/order">
                    <p class="btn-order--text">
                        Оформить заказ
                    </p>
                    <img class="btn-order--arrow" src="../assets/img/svg/ArrowApplyOrder.svg" alt="arrow">
                </RouterLink>
            </div>
        </div>
    </div>
</template>
<style scoped>
.btn--container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.promotional--text {
    color: var(--pink);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 22px;
    font-style: normal;
    font-weight: 600;
    line-height: 17px;
    margin-bottom: 50px;
}

.promotional-and-price--container {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: end;
    margin: 50px 0;
}

.promotional--container {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 353px;
}

.order---container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.order-price--container {
    display: flex;
    gap: 20px;
    align-items: center;
}

.order--price-discount {
    color: var(--pink);
    text-align: right;
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 30px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
}

.order--text {
    color: var(--light-black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: 17px;
}

.order--price {
    color: var(--yellow);
    text-align: right;
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 36px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
}

.order--discount {
    text-decoration-line: line-through;
    text-decoration-color: var(--pink);
    text-decoration-thickness: 2px;
    font-size: 24px;
}

.backet-view--container {
    width: 100%;
    max-width: 800px;

    padding: 0 10px;
    margin: 0 auto;
}

.backet--line {
    width: 2px;
    height: 23px;
    border-radius: 5px;

    flex-shrink: 0;
    border-radius: 5px;
    background: var(--black);
    transition: background 0.3s ease-in-out;
}

.btn-order--arrow {
    margin-left: 14px;

}

.btn--order {
    padding: 0 0 0 19px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--yellow);

    width: 224px;
    height: 55px;
    border-radius: 8px;

}

.btn-order--text {
    color: var(--black);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 800;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

@media (max-width:768px) {
    .promotional-and-price--container {
        flex-direction: column;
        align-items: center;
        gap: 50px;
    }

    .order---container {
        width: 100%;
    }

    .order--price-discount {
        font-size: 20px;
    }

    .order--text {
        font-size: 15px;
    }

    .order--price {
        font-size: 20px;
    }

    .btn--container {
        flex-direction: column;
        gap: 14px;
        margin-bottom: 44px;
    }

    .btn-back {
        order: 2;
    }
}
</style>
