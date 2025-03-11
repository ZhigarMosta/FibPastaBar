<script setup lang="ts">
const {
    closeModal,
} = defineProps<{
    closeModal(): void,
}>();
import { storeToRefs } from 'pinia';
import { useBacketStore } from '@/stores/backet';

const store = useBacketStore();
const { deliveryTime } = storeToRefs(store);

const timeList = ["Побыстрее", "15:00 - 15:30", "16:00 - 16:30", "17:00 - 17:30", "18:00 - 18:30", "19:00 - 19:30", "20:00 - 20:30", "21:00 - 21:30", "22:00 - 22:30", "23:00 - 23:30"];

const changeItem = (time: string): void => {
    deliveryTime.value = time;
    closeModal();
}

</script>
<template>
    <div class="delivery-time--container">
        <div class="time-radio--container" v-for="item in timeList" :key="item">
            <input class="time--input" type="radio" :id="item" @change="changeItem(item)"
                :checked="deliveryTime === item" name="delivery">
            <label class="time--label" :class="{ 'selected': deliveryTime === item }" :for="item">
                <p class="time-text">{{ item }}</p>
            </label>
        </div>
    </div>
</template>

<style scoped>
.delivery-time--container {
    display: flex;
    flex-wrap: wrap;
    row-gap: 17px;
    column-gap: 14px;
}

.time-radio--container {
    width: 100%;
    max-width: 280px;
}

.time--label {
    width: 100%;
    max-width: 280px;
    border-radius: 8px;
    background: var(--white);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    height: 51px;
    padding-left: 20px;
    display: flex;
    align-items: center;
}

.time--label.selected {
    border: 2px solid var(--yellow);
}

.time--input {
    display: none;
}

.time-text {
    flex-shrink: 0;
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.8;
}
</style>
