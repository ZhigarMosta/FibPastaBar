<script setup lang="ts">
const {
    color = "btn-color--gray",
    radius = "btn-radius--default",
    view,
    width,
    height
} = defineProps<{
    radius?: "btn-radius--default" | "btn-radius--oval";
    color?: "btn-color--gray" | "btn-color--yellow";
    view: "buy-type--pizza"| "buy-type-basket" | "buy-type-stock"
    width: number;
    height: number;
}>();

</script>
<template>
    <div :class="[radius, color]">
        <slot></slot>
    </div>
</template>

<style scoped>
.buy-type--pizza{
    width:123px;
    height:36px;
}

.buy-type-basket{
    width:160px;
    height:42px;
}

.buy-type-stock{
    width:159px;
    height:45px;
}

.btn-radius--default {
    border-radius: 8px;
}

.btn-radius--oval {
    border-radius: 28px;
}

.btn-color--gray {
    background-color: var(--btn-gray);
}

.btn-color--yellow {
    background-color: var(--btn-gray);
}
</style>
