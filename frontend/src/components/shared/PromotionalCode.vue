<script setup lang="ts">
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import ErrorMessage from '../shared/ErrorMessage.vue';
import Btn from '../features/Btn.vue';
import { ref } from 'vue';
import { useBacketStore } from '@/stores/backet';
import { storeToRefs } from 'pinia';

const store = useBacketStore()
const { discountOrder, promotionalCode } = storeToRefs(store)

const { handleSubmit, defineField } = useForm({
    validationSchema: yup.object({
        code: yup.string().required(),
    }),
});
const errorNotFound = ref("")
const [code, codeAttrs] = defineField('code');

const onPromotionalCodeActive = handleSubmit(async values => {
    errorNotFound.value = ""
    const response = await fetch('http://api.local/api/promotional_code/activate', {
        method: "POST",
        body: JSON.stringify(values),
        mode: 'cors'
    });

    const data = await response.json();

    if (data.message.includes("Not found promotional code")) {
        errorNotFound.value = "Промокод не найден"
        return
    }
    if (data.message.includes("Promotional сode expired")) {
        errorNotFound.value = "Промокод устарел"
        return
    }
    if (data.message.includes("Promotional сode not active")) {
        errorNotFound.value = "Промокод пока не используется"
        return
    }

    if (data.success) {
        if (discountOrder.value >= data.discount) {
            errorNotFound.value = "Скидка уже применина"
            return
        }
        discountOrder.value = data.discount
        promotionalCode.value = data.code
    }

    console.log(data)
});
</script>
<template>
    <form class="promotional-code--form" @submit="onPromotionalCodeActive">
        <div class="promotional-code--wrapper">
            <input class="promotional-code--input" :class="{ 'input--error': errorNotFound }" type="text" v-model="code"
                v-bind="codeAttrs" placeholder="Введите промокод" />
            <button class="promotional-code--btn">Применить</button>
        </div>
        <ErrorMessage v-if="errorNotFound" :text="errorNotFound" />
    </form>
</template>
<style scoped>
.promotional-code--wrapper {
    display: flex;
}

.promotional-code--form {
    width: 100%;
    max-width: 353px;
    height: 43px;
}

.promotional-code--btn {
    border-radius: 0 8px 8px 0;
    background: var(--yellow);
    width: 100%;
    max-width: 133px;

    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    height: 43px;
}

.promotional-code--input {
    width: 100%;
    max-width: 220px;
    border: 1.5px solid var(--v4-gray-little-dark);
    border-radius: 8px 0 0 8px;

    color: var(----v2-gray-little-dark);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
    padding-left: 24px;
    height: 43px;
}
</style>