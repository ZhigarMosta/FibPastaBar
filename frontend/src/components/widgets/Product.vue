<script setup lang="ts">
import { ref } from 'vue';
import ProductCard from '../features/ProductCard.vue';
import { useFetch } from '@/assets/fetch/fetch';

interface productInterface {
    img: string,
    name: string,
    desc: string,
    isNew: boolean,
    price: number,
}

interface categoriesInterface {
    name: string,
    anchorRef: string,
    list: Array<productInterface>,
}

interface categoriesInterface123 {
    block: {
        categories: [{
            name: string,
            anchorRef: string
            list: [{
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

const { data } = useFetch<Array<categoriesInterface123>>("http://api.local/api/category", {
    method: "GET",
    mode: 'cors',
})
console.log(data)
const categoriesList = ref<Array<categoriesInterface>>([
    { name: "Пицца", anchorRef: "pizza", list: [{ img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 },] },
    { name: "Паста", anchorRef: "pasta", list: [{ img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 },] }
])

</script>
<template>
    <div class="categories--container">
        <div class="categories-list--container" v-for="categories of categoriesList">
            <p class="categories--text" :id="categories.anchorRef">{{ categories.name }}</p>
            <div class="product-list">
                <ProductCard v-for="product of categories.list" :img="product.img" :product-name="product.name"
                    :desc="product.desc" :price="product.price" :is-new="product.isNew" />
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