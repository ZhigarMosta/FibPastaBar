<script setup lang="ts">
import { ref } from 'vue';
import ProductCard from '../features/ProductCard.vue';

interface productInterface {
    img: string,
    name: string,
    desc: string,
    isNew: boolean,
    price: number,
}

interface categoriesInterface {
    categories: string,
    anchorRef: string,
    list: Array<productInterface>,
}

const categoriesList = ref<Array<categoriesInterface>>([
    { categories: "Пицца", anchorRef: "#pizza", list: [{ img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 },] },
    { categories: "Паста", anchorRef: "#pasta", list: [{ img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: false, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 }, { img: "/src/assets/gag/pizza.png", name: "С креветками и трюфелями", desc: "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г", isNew: true, price: 500 },] }
])
</script>
<template>
    <div class="categories--container">
        <div class="categories-list--container" v-for="categories of categoriesList">
            <p class="categories--text" :id="categories.anchorRef">{{ categories.categories }}</p>
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