<script setup lang="ts">
import { RouterLink } from 'vue-router';
import Btn from '../features/Btn.vue';
import ContentBtn from '../shared/ContentBtn.vue';
</script>
<template>
    <header>
        <input id="menu-toggle" type="checkbox" />
        <div class="head">
            <div class="wrapper_header">
                <div class="top-header--container">
                    <div class="container--information">
                        <img src="/src/assets/img/png/logo.png" alt="logo">
                        <div class="toggle--container">
                            <div class="media-block--container">
                                <p class="number-phone--text">
                                    8 499 391-84-49
                                </p>
                                <Btn view="btn-type--basket">
                                    <ContentBtn view="content-type--basket">
                                        <template #text>
                                            Корзина
                                        </template>
                                        <template #count>
                                            {{ 1 }}
                                        </template>
                                    </ContentBtn>
                                </Btn>
                            </div>
                            <label class="menu-button-container" htmlFor="menu-toggle">
                                <div class="menu-button"></div>
                            </label>
                        </div>
                        <div class="container--inf-yandex">
                            <p class="text-delivery--default">Доставка пасты <span
                                    class="text-delivery--yellow">Москва</span></p>
                            <div class="yandex-food-and-time-delivery--container">
                                <div class="wrapper--yandex-food">
                                    <img class="img-yandex-food" src="/src/assets/img/png/yandexFood.png"
                                        alt="yandex-food">
                                    <p class="yandex-food-and-time-delivery--text">Яндекс еда</p>
                                    <div class="circle"></div>
                                    <div class="yandex-food-and-time-delivery--text">4.8</div>
                                    <img class="star" src="/src/assets/img/svg/star.svg" alt="star">
                                </div>
                                <div class="wrapper--time-delivery">
                                    <p class="yandex-food-and-time-delivery--text">Время доставки</p>
                                    <div class="circle"></div>
                                    <p class="yandex-food-and-time-delivery--text">от 31 мин</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="number-phone--container">
                        <Btn view="btn-type--call">
                            <ContentBtn>Заказать звонок</ContentBtn>
                        </Btn>
                        <p class="number-phone--text">
                            8 499 391-84-49
                        </p>
                    </div>
                </div>
                <div class="bottom-header--container">
                    <div class="menu--container">
                        <RouterLink class="menu--text" to="/">Home</RouterLink>
                        <RouterLink class="menu--text" to="/about">about</RouterLink>
                        <RouterLink class="menu--text" to="/">Home</RouterLink>
                        <RouterLink class="menu--text" to="/">Home</RouterLink>
                    </div>
                    <div class="login-and-backet--container">
                        <button class="login--btn">Войти</button>
                        <p class="number-phone--text number-phone--media">
                            8 499 391-84-49
                        </p>
                        <Btn class="bottom-header--basket" view="btn-type--basket">
                            <ContentBtn view="content-type--basket">
                                <template #text>
                                    Корзина
                                </template>
                                <template #count>
                                    {{ 1 }}
                                </template>
                            </ContentBtn>
                        </Btn>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
<style scoped>
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



.login--btn {
    color: var(--gray);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;

}

.yandex-food-and-time-delivery--text {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 13px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;

}

.text-delivery--default,
.text-delivery--yellow {
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.text-delivery--yellow {
    color: var(--yellow);
}

.number-phone--text {
    color: var(--yellow);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 26px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;

}

.media-block--container {
    display: none;
}

.top-header--container {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.container--information {
    display: flex;
    justify-content: space-between;
    align-items: center;

    width: 100%;
    max-width: 515px;
}

.container--inf-yandex {
    display: flex;
    flex-direction: column;
    gap: 9px;
    justify-content: center;
}

.yandex-food-and-time-delivery--container {
    display: flex;
    gap: 20px;
}

.wrapper--yandex-food {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 7px;
}

.img-yandex-food {
    width: 18px;
    height: 18px;

}

.circle {
    width: 4px;
    height: 4px;
    background-color: var(--pink);
    border-radius: 50%;

    margin-top: 2px;
}

.star {
    width: 14px;
    height: 16px;
    margin-left: -3px;
}

.wrapper--time-delivery {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 7px;
}

.number-phone--container {
    display: flex;
    justify-content: space-between;
    align-items: center;

    width: 100%;
    max-width: 395px;
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
    max-width: 1440px;
    background-color: var(--white);
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
    width: 1440px;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    gap: 20px;

    padding: 0 15px;
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

@media (max-width: 900px) {

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

    .bottom-header--basket {
        display: none;
    }

    .toggle--container {
        width: 100%;
        max-width: 464px;

        display: flex;
        align-items: center;
        gap: 20px;
    }

    .media-block--container {
        display: flex;
        align-items: baseline;
        gap: 20px;
    }

    .container--information {
        max-width: 100%;
    }

    .container--inf-yandex,
    .number-phone--container {
        display: none;
    }

    .menu-button-container {
        display: flex;
    }

    .menu--container {
        flex-direction: column;
    }

    .bottom-header--container {
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
        width: 1135px;
        gap: 50px;
        margin-top: 20px;
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

    .bottom-header--basket {
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

    .number-phone--text {
        color: var(--light-black);
        width: 150px;
        font-size: 18px;
    }

    .bottom-header--basket {
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