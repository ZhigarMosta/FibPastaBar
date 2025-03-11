<script setup lang="ts">
import closeBtn from "@/assets/img/png/closeModal.png"
import { ref } from "vue";

const {
    text,
    view
} = defineProps<{
    text?: string,
    view: string
}>();
const modalIsOpen = ref(false)


const open = () => {
    modalIsOpen.value = !modalIsOpen.value
}
const close = () => {
    modalIsOpen.value = !modalIsOpen.value
}
defineExpose({
    modalIsOpen, open, close
})

</script>
<template>
    <div class="modal--wrapper" v-if="modalIsOpen">
        <div class="modal--container" :class="'modal-view--' + view">
            <div class="modal-top--container">
                <p class="modal-text" :class="'modal-text-view--' + view">{{ text }}</p>
                <button @click="close()" class="modal-close-btn"><img class="modal-close-img" :src="closeBtn"
                        alt="close">
                </button>
            </div>
            <slot></slot>
        </div>
    </div>
</template>
<style scoped>
.modal-top--container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-text {
    font-family: "Montserrat-ExtraBold", sans-serif;
    font-size: 32px;
    font-style: normal;
    font-weight: 800;
    line-height: 17px;
}

.modal--wrapper {
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    background: linear-gradient(0deg, rgba(247, 210, 45, 0.40) 0%, rgba(247, 210, 45, 0.40) 100%), rgba(33, 49, 52, 0.20);
    z-index: 6;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal--container {
    z-index: 3;
    border-radius: 25px;
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08), 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    max-width: 90%;
    max-height: 90%;
    overflow: auto;
    padding: 40px;

    width: 100%;
    max-width: 668px;

    display: flex;
    flex-direction: column;
    gap: 40px;
}

.modal-view--white {
    background: var(--white);
}

.modal-text-view--light-blue {
    color: var(--gray);
}

.modal-view--light-blue {
    background: var(--light-blue);
}

.modal-text-view--white {
    color: var(--yellow);
}

.modal-close-img {
    width: 40px;
    height: 40px;
}
</style>