<script setup lang="ts">
const {
    width,
} = defineProps<{
    width: number;
    // height: number;
}>();

</script>

<template>
    <div>
        <slot></slot>
    </div>
</template>

<style scoped>
/* .content-btn--defualt {} */
</style>
