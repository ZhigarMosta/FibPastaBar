<script setup lang="ts">
import DeleteProduct from '../shared/DeleteProduct.vue';
import IncDecProduct from '../shared/IncDecProduct.vue';
const {
    id,
    img,
    name,
    price,
    count,
    description
} = defineProps<{
    id: number,
    img: string,
    name: string,
    price: number,
    count: number,
    description: string
}>();
</script>
<template>
    <div class="item--container">
        <div class="item-img-and-text--container">
            <img class="item--img" :src="img" alt="item">
            <div class="item-text--container">
                <p class="text--name">{{ name }}</p>
                <p class="text--description">{{ description }}</p>
            </div>
        </div>
        <div class="item-price-and-btn--container">
            <p class="item--price">{{ price }}</p>
            <img class="item--img-media" :src="img" alt="item">
            <div class="item-btn--container">
                <IncDecProduct :count="count" :id="id" />
                <DeleteProduct :id="id" />
            </div>
        </div>
    </div>
</template>
<style scoped>
.item--img-media {
    display: none;
}

.item-btn--container {
    display: flex;
    gap: 34px;
}

.item--container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 36px;

    padding: 27px 0;
    border-bottom: 1px solid var(--v3-gray-little-dark);
}

.item--container:nth-child(2) {
    border-top: 1px solid var(--v3-gray-little-dark);
    margin-top: 33px;
}

.item-img-and-text--container {
    display: flex;
    gap: 25px;
    align-items: center;
}

.item--img,.item--img-media  {
    width: 70px;
    height: 70px;
}

.item-text--container {
    display: flex;
    flex-direction: column;
    gap: 9px;
    width: 100%;
    max-width: 409px;
}

.text--name {
    color: var(--light-black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 19px;
    font-style: normal;
    font-weight: 700;
    line-height: 17px;
}

.text--description {
    color: var(--v2-gray-little-dark);
    font-family: "Montserrat-Medium", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 500;
    line-height: 19px;
}

.item-price-and-btn--container {
    display: flex;
    align-items: center;
    gap: 34px;
}

.item--price {
    color: var(--yellow);
    text-align: center;
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 24px;
    font-style: normal;
    font-weight: 800;
    line-height: normal;
}

@media (max-width:768px) {
    .item--container {
        flex-direction: column;
        gap: 13px;
    }

    .item-img-and-text--container {
        flex-wrap: wrap;
        max-width: 100%;
        min-width: 100%;
        order: 2;
    }

    .item-text--container {
        max-width: 100%;
        min-width: 100%;
        width: 100%;
    }
    .item--img{
        display: none;
    }
    .item--img-media {
        display: block;
    }
    .item--price{
        display: none;
    }
    .item-price-and-btn--container{
        justify-content: space-between;
        width: 100%;
    }
}
</style>