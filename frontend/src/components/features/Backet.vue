<script setup lang="ts">
import { useBacketStore, type BacketInterface } from '@/stores/backet';
import ProductInBacket from './ProductInBacket.vue';
import { storeToRefs } from 'pinia';

const store = useBacketStore();
const { backet, costOrder, discountOrder } = storeToRefs(store);

</script>

<template>
    <div class="product-in-backet--arrow"></div>
    <div class="backet--container">
        <div class="backet-list--container">
            <div class="backet-list">
                <ProductInBacket :key="product.id" v-for="product of backet" :count="product.count" :img="product.img"
                    :price="product.price" :product-name="product.name" :id="product.id" />
            </div>
            <div class="order-amount--container">
                <p class="order-text--amount">Сумма заказа</p>
                <div class="price-order--container">
                    <p class="order-text--order" :class="{ 'order-text-order--discount': discountOrder > 0 }">{{
                        costOrder }} ₽</p>
                    <p class="order-text--order--discount" v-if="discountOrder > 0">{{ costOrder - (costOrder *
                        discountOrder * 0.01) }} ₽</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.order-text--order--discount {
    color: var(--pink);
    text-align: right;
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
}

.order-text-order--discount {
    text-decoration-line: line-through;
    text-decoration-color: var(--pink);
    text-decoration-thickness: 2px;
}

.price-order--container {
    display: flex;
    gap: 10px;
}

.backet--container {
    width: 350px;
    padding-top: 15px;
    position: absolute;
    margin-left: -190px;
}

.backet-list--container {
    width: 350px;
    position: absolute;
    border-radius: 10px;
    border: 3.5px solid rgba(247, 210, 45, 0.40);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    padding: 24px;
    background-color: var(--white);
}

.backet-list {
    max-height: 220px;
    overflow-y: auto;

    display: flex;
    flex-direction: column;
    gap: 18px;
    padding-right: 20px;
}

.order-amount--container {
    display: flex;
    justify-content: space-between;

    align-items: center;
}

.order-text--amount {
    color: var(--light-black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 600;
    line-height: 17px;
}

.order-text--order {
    color: var(--yellow);
    text-align: right;
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
}

.product-in-backet--arrow {
    background-color: var(--white);
    position: absolute;

    width: 23px;
    height: 23px;

    z-index: 1;
    margin-left: 100px;
    margin-top: 10px;
    transform: rotate(45deg);
}

@media (max-width:768px) {
    .backet--container {
        width: 300px;
        margin-top: -310px;
        margin-left: -140px;
    }

    .backet-list--container {
        width: 300px;
        padding: 15px;
    }

    .product-in-backet--arrow {
        margin-left: 100px;
        margin-top: -30px;
    }
}
</style>