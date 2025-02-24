<script setup lang="ts">
import { ref } from 'vue';
import ProductCard from '../features/ProductCard.vue';
import { useFetch } from '@/composables/fetches/fetch';
import Backet from '../features/Backet.vue';

interface productInterface {
    img: string,
    name: string,
    desc: string,
    isNew: boolean,
    price: number,
}

interface categoriesInterface {
    block: {
        categories: [{
            name: string,
            anchorRef: string
            list: [{
                id: number
                img: string
                name: string
                description: string
                isNew: boolean
                price: number
            }]
        }],
        products_new: [{
            img: string
            name: string
            price: number
        }]
    },
    name: string,
    anchorRef: string,
    list: Array<productInterface>,
}

const { data: CategoriesList } = useFetch<categoriesInterface>("http://api.local/api/category", {
    method: "GET",
    mode: 'cors',
})

</script>
<template>
    <div class="categories--container">
        <div class="categories-list--container" v-for="categories of CategoriesList?.block.categories">
            <p class="categories--text" :id="categories.anchorRef">{{ categories.name }}</p>
            <div class="product-list">
                <ProductCard v-for="product of categories.list" :id="product.id"
                    :img="'http://api.local/' + product.img" :product-name="product.name" :desc="product.description"
                    :price="product.price" :is-new="product.isNew" />
            </div>
        </div>
    </div>
</template>
<style scoped>
.categories--container {
    width: 100%;
    max-width: 1114px;

    display: flex;
    flex-direction: column;
    gap: 50px;
    margin-bottom: 55px;
}

.categories-list--container {
    display: flex;
    flex-direction: column;

    gap: 26px;
}

.product-list {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;

    column-gap: 30px;
    row-gap: 50px;
}

.categories--text {
    color: var(--yellow);
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 32px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;

}
</style>