<script setup lang="ts">
import { useBacketStore } from '@/stores/backet';
import { storeToRefs } from 'pinia';
import { ref } from 'vue';
import { RouterLink } from 'vue-router';
import Backet from '@/components/features/Backet.vue';

const store = useBacketStore()
const { countProductInBacket } = storeToRefs(store)

const {
    view,

} = defineProps<{
    view: "header" | "body"
}>();

const toRef = ref("#")
const BacketIsOpen = ref(false)
if (view === "header") {
    toRef.value = "/backet"
}
else {
    toRef.value = "#"
}
function handleClick() {
    if (view == "body") {
        BacketIsOpen.value = !BacketIsOpen.value
    }
}
function handleMouseOver() {
    if (window.innerWidth > 768 && view == "header") {
        BacketIsOpen.value = true
    }
}
function handleMouseLeave() {
    if (window.innerWidth > 768 && view == "header") {
        BacketIsOpen.value = false
    }
}
</script>
<template>
    <div class="backet--container" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
        <RouterLink @click="handleClick()" :to="toRef" :class="'backet-' + view + '--container'">
            <p class="backet--text">
                Корзина
            </p>
            <div class="backet--line"></div>
            <p class="backet--text">
                {{ countProductInBacket }}
            </p>
        </RouterLink>
        <Backet v-if="BacketIsOpen" />
    </div>
</template>
<style scoped>
.backet--line {
    width: 2px;
    height: 23px;
    border-radius: 5px;

    flex-shrink: 0;
    border-radius: 5px;
    background: var(--black);
    transition: background 0.3s ease-in-out;
}

.backet-header--container,
.backet-body--container {
    width: 160px;
    background-color: var(--yellow);
    padding: 7px 25px;
    border-radius: 8px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.backet--text {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    transition: color 0.3s ease-in-out;
}

.backet-header--container:hover .backet--text,
.backet-body--container:hover .backet--text {
    color: var(--white);
}

.backet-header--container:hover .backet--line,
.backet-body--container:hover .backet--line {
    background-color: var(--white);
}

@media (max-width:768px) {
    .backet-header--container {
        background-color: var(--white);
    }

    .backet-header--container:hover .backet--text {
        color: var(--gray);
    }

    .backet-header--container:hover .backet--line {
        background-color: var(--gray);
    }
}
</style>