<script setup lang="ts">
import { RouterLink, useRoute } from 'vue-router';
import { useFetch } from '@/composables/fetches/fetch';
import BacketBtn from '../features/BacketBtn.vue';
import { computed, inject, ref } from 'vue';
import { system } from '@ankasru/utils-ts';

const route = useRoute();
const layoutsMap = {
    backet: {
        progress: "backet"
    },
    orderDesign: {
        progress: "orderDesign"
    },
    orderAccepted: {
        progress: "orderAccepted"
    },
}

const layoutComponents = computed(() => layoutsMap[route?.meta?.progress ?? "backet"]);


interface navigationInerface {
    navigation: [{
        name: string,
        anchorRef: string
    }]
}
const { data } = useFetch<navigationInerface>("http://api.local/api/header", {
    method: "GET",
    mode: 'cors',
})

const userIsLogin = inject("userIsLogin")
const modalIsOpen = ref(false)

const onLogout = async () => {
    const response = await fetch('http://api.local/api/auth/logout', {
        method: "GET",
        mode: 'cors'
    });

    const data = await response.json();
    const cookies = system.parseCookies();

    if (data.success) {
        if (cookies) {
            cookies.removeCookie("session")
        }
    }
}
</script>
<template>
    <header>
        <input id="menu-toggle" type="checkbox" />
        <div class="head">
            <div class="wrapper_header">
                <div class="container--information">
                    <div class="logo-and-progress">
                        <RouterLink to="/"><img class="logo" src="/src/assets/img/png/logo.png" alt="logo"></RouterLink>
                    </div>
                    <div class="progress-bars">
                        <div class="progress--backet">
                            <div class="circle" :class="{ 'circle--active': layoutComponents?.progress === 'backet' }">1
                            </div>
                            <p class="progress-text"
                                :class="{ 'progress-text--active': layoutComponents?.progress === 'backet' }">Корзина
                            </p>
                        </div>
                        <div class="progress--line"></div>
                        <div class="progress--order-design">
                            <div class="circle"
                                :class="{ 'circle--active': layoutComponents?.progress === 'orderDesign' }">2
                            </div>
                            <p class="progress-text"
                                :class="{ 'progress-text--active': layoutComponents?.progress === 'orderDesign' }">
                                Оформление
                                заказа</p>
                        </div>
                        <div class="progress--line"></div>
                        <div class="progress--order-accepted">
                            <div class="circle"
                                :class="{ 'circle--active': layoutComponents?.progress === 'orderAccepted' }">3</div>
                            <p class="progress-text"
                                :class="{ 'progress-text--active': layoutComponents?.progress === 'orderAccepted' }">Заказ
                                принят</p>
                        </div>
                    </div>
                    <div class="toggle--container">
                        <label class="menu-button-container" htmlFor="menu-toggle">
                            <div class="menu-button"></div>
                        </label>
                    </div>
                </div>
                <div class="bottom-header--container">
                    <div class="menu--container">
                        <a v-for="i of data?.navigation" class="menu--text" :href='"#" + i.anchorRef'>{{ i.name }}</a>
                        <RouterLink class="menu--text" to="/">Home</RouterLink>
                        <RouterLink class="menu--text" to="/about">about</RouterLink>
                    </div>
                    <div class="login-and-backet--container">
                        <button v-if="!userIsLogin" class="login--btn"
                            @click="() => modalIsOpen = !modalIsOpen">Войти</button>
                        <button @click="onLogout()" v-else class="login--btn">Выйти</button>
                        <p class="number-phone--text number-phone--media">
                            8 499 391-84-49
                        </p>
                        <BacketBtn view="header" class="bottom-header--backet--btn" />
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
<style scoped>
.logo{
    width: 82.0px;
    height: 60.6px;
}
.circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;

    color: var(--yellow);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    background-color: none;
    border: solid 2px var(--yellow);

    display: flex;
    align-items: center;
    justify-content: center;
}

.circle--active {
    background-color: var(--yellow);
    color: var(--black);
}

.progress-text {
    color: var(--gray);
}

.progress-text--active {
    color: var(--light-black);
    text-align: center;
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
}

.progress-bars {
    display: flex;
    align-items: center;
}

.progress--backet,
.progress--order-design,
.progress--order-accepted {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
}

.progress--backet {
    margin-right: 5px;
}

.progress--order-design {
    margin-left: -45px;
    margin-right: -45px;
}

.progress--order-accepted {
    margin-left: -15px;
}

.progress--line {
    border-top: 2px dashed var(--v6-gray-little-dark);
    width: 102px;
    margin-bottom: 25px;
}


.progress-bars {
    width: 100%;
    display: flex;
    justify-content: end;
}

.container--information {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

@media (max-width: 1110px) {
    .progress-bars {
        padding-right: 100px;
    }
}

@media (max-width: 768px) {
    .container--information {
        gap: 12px;
    }

    .logo-and-progress {
        order: 1;
    }

    .progress-bars {
        order: 3;
        width: 100%;
        padding: 0;

        justify-content: space-between;
    }

    .progress--line {
        width: 40px;
    }

    .progress-text {
        font-size: 11px;
    }

    .toggle--container {
        order: 2;
    }

    .container--information {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .progress--backet {
        margin-right: 2px;
    }

    .progress--order-design {
        margin-left: -22px;
        margin-right: -22px;
    }

    .progress--order-accepted {
        margin-left: -6px;
    }

}

@font-face {
    font-family: "Montserrat-Bold";
    src: url("../../assets/fonts/Montserrat-Bold.ttf") format("ttf");
}

@font-face {
    font-family: "Montserrat-ExtraBold";
    src: url("../../assets/fonts/Montserrat-ExtraBold.ttf") format("ttf");
}

@font-face {
    font-family: "Montserrat-SemiBold";
    src: url("../../assets/fonts/Montserrat-SemiBold.ttf") format("ttf");
}

.number-phone--text {
    color: var(--light-black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;
    width: 150px;
}

.menu--text.router-link-exact-active {
    color: var(--gray-dark);
}

.login--btn {
    color: var(--gray);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;

}

.media-block--container {
    display: none;
}

.container--information {
    display: flex;
    justify-content: space-between;
    align-items: center;

    width: 100%;
}

.login-and-backet--container {
    width: 100%;
    max-width: 245px;

    display: flex;
    justify-content: space-around;
    align-items: center;
}

.menu--container {
    display: flex;
    gap: 15px;
}

.number-phone--media {
    display: none;
    text-align: center;
}

header {
    z-index: 5;
    position: fixed;
    top: 0;
    width: 100%;
    background-color: var(--white);

    border-bottom: 1px solid var(--v3-gray-little-dark);
}

.logoTextHeder {
    font-family: "IBM Plex Sans", sans-serif;
    font-weight: 600;
    font-size: 24px;
    line-height: 140%;
    text-align: center;
    color: #fff;
}

.head {
    display: flex;
    justify-content: center;
    background-color: var(--white);
}

.wrapper_header {
    width: 1110px;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    gap: 20px;

    margin-top: 20px;
}

.container_logo {
    display: flex;
    align-items: center;
}

.logoHeader {
    display: flex;
    gap: 21px;
}

.bottom-header--container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;

    display: none;
}

#menu-toggle {
    display: none;
}

.menu-button,
.menu-button::before,
.menu-button::after {
    display: block;
    background-color: var(--v2-gray-little-dark);
    position: absolute;
    height: 3px;
    width: 46px;
    transition: transform 400ms cubic-bezier(0.23, 1, 0.32, 1);
    border-radius: 2px;
}

.menu-button::before {
    content: "";
    margin-top: -9px;
}

.menu-button::after {
    content: "";
    margin-top: 9px;
}

.menu-button-container {
    display: none;
}

.menu--text.router-link-exact-active {
    color: var(--gray-dark);
}

.menu--text {
    font-family: "Montserrat-SemiBold", sans-serif;
    font-weight: 600;
    font-size: 15px;
    line-height: 140%;
    text-align: center;
    color: var(--light-black);

    position: relative;
    text-decoration: none;
    transition: color 0.3s;

    &::after {
        content: "";
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: var(--gray);
        transition: width 0.3s;
    }

    &:hover::after {
        width: 100%;
    }

    &:hover {
        color: var(--gray);
    }
}

#menu-toggle:checked~.head .menu-button-container .menu-button::before {
    margin-top: 0px;
    transform: rotate(405deg);
}

#menu-toggle:checked~.head .menu-button-container .menu-button {
    background: rgba(255, 255, 255, 0);
}

#menu-toggle:checked~.head .menu-button-container .menu-button::after {
    margin-top: 0px;
    transform: rotate(-405deg);
}

@media (max-width: 1110px) {

    .login-and-backet--container {
        max-width: 50px;
    }

    .bottom-header--container {
        align-items: start;
    }

    .menu--container {
        gap: 5px;
    }

    .login--btn {
        font-family: "Montserrat-ExtraBold", sans-serif;
        color: var(--yellow);
        margin-left: 56px;
        margin-bottom: 20px;
    }

    .bottom-header--backet--btn {
        display: none;
    }

    .toggle--container {
        width: 100%;
        max-width: 46px;

        display: flex;
        align-items: center;
        gap: 20px;
    }

    .media-block--container {
        display: flex;
        align-items: baseline;
        gap: 20px;
    }

    .menu-button-container {
        display: flex;
    }

    .menu--container {
        flex-direction: column;
    }

    .bottom-header--container {
        display: flex;
        position: absolute;
        top: 0px;
        right: 20px;
        width: 140px;

        flex-direction: column;
        justify-content: center;
        align-items: start;
        gap: 0;

        border-radius: 5px;
        background-color: var(--white);
    }

    #menu-toggle~.head .bottom-header--container {
        margin: 0;
        margin-top: -350px;
        padding: 0;
        border: 0;
        transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1),
            margin-top 200ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    #menu-toggle:checked~.head .bottom-header--container {
        padding: 0.2em;
        margin-top: 80px;
        transition: height 400ms cubic-bezier(0.23, 1, 0.32, 1),
            margin-top 200ms cubic-bezier(0.23, 1, 0.32, 1);
    }

    .head .bottom-header--container>.menu--text {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin: 0;
        padding: 0.5em 0;
        width: 100%;
        background-color: var(--yellow);
    }

    .head {
        display: flex;
        justify-content: space-between;
    }

    .wrapper_header {
        display: flex;
        justify-content: center;
        width: 1100px;
        gap: 50px;
        margin-top: 20px;
        padding: 0 15px;
    }

    .menu-button-container {
        display: block;
    }

    .menu--container {
        padding-left: 29px;
        padding-top: 20px;
    }
}

@media (max-width: 768px) {
    .menu--container {
        padding: 0px;
    }

    .bottom-header--container {
        align-items: center;
    }

    .number-phone--media {
        display: block;
    }

    .login-and-backet--container {
        flex-direction: column;
    }

    .bottom-header--backet--btn {
        display: block;
        margin-bottom: 30px;
    }

    .media-block--container {
        display: none;
    }

    .toggle--container {
        max-width: 46px;
    }

    .bottom-header--container {
        left: 0;
        width: 100%;
        border-radius: 0;
        background-color: var(--yellow);
    }

    .login--btn {
        color: var(--light-black);
        margin: 10px 0 10px 0;
    }

    .menu--container {
        padding-left: 0px;
    }

    .bottom-header--backet--btn {
        display: flex;
        align-items: center;
        margin-top: 10px;
    }

    #menu-toggle:checked~.head {
        background: var(--yellow);
        transition: background 400ms cubic-bezier(0.23, 1, 0.32, 1),
    }
}
</style>