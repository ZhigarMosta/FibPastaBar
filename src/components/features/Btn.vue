<script setup lang="ts">
const {
    as = 'btn-defualt',
} = defineProps<{
    as?: 'nav' | 'div';
}>();

</script>

<template>
    <div class="greetings">
        <slot></slot>
    </div>
</template>

<style scoped>

</style>
