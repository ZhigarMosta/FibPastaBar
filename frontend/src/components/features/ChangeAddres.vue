<script setup lang="ts">
import ChangeTime from '@/components/features/ChangeTime.vue';
import FormChangeUserEmail from '@/components/features/FormChangeUserEmail.vue';
import FormChangeUserName from '@/components/features/FormChangeUserName.vue';
import FormDelivery from '@/components/features/FormDelivery.vue';
import ModalRoot from '@/components/shared/ModalRoot.vue';
import { useBacketStore } from '@/stores/backet';
import { useUserStore } from '@/stores/user';
import { storeToRefs } from 'pinia';
import { computed, ref, useTemplateRef } from 'vue';

const storeUser = useUserStore();
const { user } = storeToRefs(storeUser);

const storeBacket = useBacketStore();
const { delivery, deliveryTime } = storeToRefs(storeBacket);

enum ModalStateEnum {
    Email,
    Address,
    Time,
    Name
}

const modalState = ref<ModalStateEnum>(ModalStateEnum.Email)

const onEditModalState = (type: ModalStateEnum): void => {
    modalState.value = type
    modalRootRef.value?.OpenOrclose()
}

const activeEditComponent = computed(() => {
    const components = {
        [ModalStateEnum.Email]: {
            title: 'Редактировать почту',
            component: FormChangeUserEmail,
            viewModal: "white"
        },
        [ModalStateEnum.Name]: {
            title: 'Редактировать имя',
            component: FormChangeUserName,
            viewModal: "white"
        },
        [ModalStateEnum.Address]: {
            title: 'Куда доставить?',
            component: FormDelivery,
            viewModal: "white"
        },
        [ModalStateEnum.Time]: {
            title: 'Время доставки',
            component: ChangeTime,
            viewModal: "light-blue"
        }
    };

    return components[modalState.value]
});

const modalRootRef = useTemplateRef('modalRoot')

const validateAddress = (): boolean => {
    if (delivery.value.addres.apartment && delivery.value.addres.sity && delivery.value.addres.house && delivery.value.addres.floor && delivery.value.addres.entrance) return true
    return false
}

const CangePickuptoTrue = (): void => {
    const updatedAddress = {
        ...delivery.value,
        pickup: true
    };

    delivery.value = updatedAddress;
}

const CangePickuptoFalse = (): void => {
    const updatedAddress = {
        ...delivery.value,
        pickup: false
    };

    if (validateAddress()) {
        delivery.value = updatedAddress;
        return
    }

    modalRootRef.value?.OpenOrclose()
}


const OpenModal = () => { modalRootRef.value?.OpenOrclose() }
const StateToAddres = onEditModalState(ModalStateEnum.Address)
const StateToName = onEditModalState(ModalStateEnum.Name)
const StateToEmail = onEditModalState(ModalStateEnum.Email)

defineExpose({
    OpenModal, StateToAddres, StateToName, StateToEmail
})

</script>
<template>
    <div class="delivery-addres-information">
        <div class="information-block">
            <div class="information-name--container">
                <p class="information-name">Имя</p>
            </div>
            <div class="information-content--container">
                <p class="information-content--text">{{ user.name }}</p>
                <button class="btn-change-information" @click="onEditModalState(ModalStateEnum.Name)">Изменить</button>
            </div>
        </div>
        <div class="information-block">
            <div class="information-name--container">
                <p class="information-name">Почта</p>
            </div>
            <div class="information-content--container">
                <p class="information-content--text">{{ user.email }}</p>
                <button class="btn-change-information" @click="onEditModalState(ModalStateEnum.Email)">Изменить</button>
            </div>
        </div>
        <div class="information-block">
            <div class="information-name--container">
                <p class="information-name">Адрес доставки</p>
            </div>
            <div class="information-content--container">
                <div class="addres-content--container" v-if="delivery.pickup">
                    <p class="information-content--text-name-addres">Самовывоз</p>
                </div>
                <div class="addres-content--container" v-else>
                    <p class="information-content--text-name-addres">{{ delivery.addres.nameAddres }}</p>
                    <p class="information-content--text">{{ delivery.addres.sity }}, {{ delivery.addres.house
                    }}, {{ delivery.addres.floor }}</p>
                    <p class="information-content--text">{{ delivery.addres.entrance }}, {{
                        delivery.addres.apartment }}, {{ delivery.addres.code }}</p>
                </div>
                <div class="btn-change--container">
                    <button @click="onEditModalState(ModalStateEnum.Address)"
                        class="btn-change-information">Изменить</button>
                    <button @click="CangePickuptoFalse()" v-if="delivery.pickup"
                        class="btn-change-information">Доставить?</button>
                    <button @click="CangePickuptoTrue()" v-else class="btn-change-information">Выбрать
                        самовывоз</button>
                </div>
            </div>
        </div>
        <div class="information-block">
            <div class="information-name--container">
                <p class="information-name">Время доставки</p>
            </div>
            <div class="information-content--container">
                <p class="information-content--text">{{ deliveryTime }}</p>
                <button class="btn-change-information" @click="onEditModalState(ModalStateEnum.Time)">Изменить</button>
            </div>
        </div>
    </div>
    <ModalRoot ref="modalRoot" v-if="modalState != undefined" :view="activeEditComponent.viewModal"
        :text="activeEditComponent.title">
        <component :is="activeEditComponent.component" :OpenOrclose="() => modalRootRef?.OpenOrclose()" />
    </ModalRoot>
</template>
<style scoped>
.promotional--container {
    display: flex;
    flex-direction: column;
    gap: 27px;
    margin-top: 40px;
}

.promotional--text {
    color: var(--yellow);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 22px;
    font-style: normal;
    font-weight: 600;
    line-height: 17px;
}

.addres-content--container {
    margin-bottom: 20px;
}

.btn-change--container {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.delivery-addres-information {
    margin-top: 30px;

    display: flex;
    flex-direction: column;
    gap: 14px;
}

.btn-change-information {
    color: var(--yellow);
    text-align: right;
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.82;

}

.information-content--text-name-addres {
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
    opacity: 0.82;

}

.information-content--text {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.82;

}

.information-content--container {
    display: flex;
    justify-content: space-between;

    width: 100%;
    border: 1.5px solid var(--gray-light);
    background: var(--v7-gray-little-dark);
    border-radius: 7px;
    padding: 10px 20px;
}

.information-name {
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 500;
    line-height: 28px;
    opacity: 0.7;
}

.information-block {
    display: flex;
    align-items: center;
}

.information-name--container {
    width: 100%;
    max-width: 190px;
}
</style>