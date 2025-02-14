<script setup lang="ts">
import Btn from '../features/Btn.vue';
import ContentBtn from '../shared/ContentBtn.vue';
</script>
<template>
    <footer>
        <div class="social-network--wrapper">
            <div class="social-network-and-logo--container">
                <div class="logo--container">
                    <img src="/src/assets/img/png/logo.png" alt="logo">
                    <div class="media-phone--container">
                        <p class="number--text">8 499 391-84-49</p>
                        <Btn class="btn--call" view="btn-type--call">
                            <ContentBtn>
                                Заказать звонок
                            </ContentBtn>
                        </Btn>
                    </div>
                </div>
                <div class="social-net-work-and-information--container">
                    <div class="information--container">
                        <p class="information-title--text-info">Калорийность и состав</p>
                        <p class="information-title--text-info">Правовая информация</p>
                    </div>
                    <div class="social-net-work--container">
                        <p class="information-title--text-social">Мы в соцсетях</p>
                        <div class="social-net-work--lsit">
                            <div class="social-net-work--first-block">
                                <p class="social-net-work--text">YouTube</p>
                                <p class="social-net-work--text">Instagram</p>
                            </div>
                            <div class="social-net-work--second-block">
                                <p class="social-net-work--text">Facebook</p>
                                <p class="social-net-work--text">ВКонтакте</p>
                            </div>
                            <div class="social-net-work--third-block">
                                <p class="social-net-work--text social-net-work--text--addres">Москва ул. Проспект</p>
                                <p class="social-net-work--text social-net-work--text--addres">Вернадского 86В</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="question--container">
                <p class="question-text">Остались вопросы? А мы всегда на связи:</p>
                <div class="question-icon--container">
                    <Btn view="btn-type--footer">
                        <ContentBtn>
                            <img class="btn-footer--img" src="/src/assets/img/png/viber.png" alt="mastercard">
                        </ContentBtn>
                    </Btn>
                    <Btn view="btn-type--footer">
                        <ContentBtn>
                            <img class="btn-footer--img" src="/src/assets/img/png/skype.png" alt="mastercard">
                        </ContentBtn>
                    </Btn>
                    <Btn view="btn-type--footer">
                        <ContentBtn>
                            <img class="btn-footer--img" src="/src/assets/img/png/lightning.png" alt="mastercard">
                        </ContentBtn>
                    </Btn>
                    <Btn view="btn-type--footer">
                        <ContentBtn>
                            <img class="btn-footer--img" src="/src/assets/img/png/tg.png" alt="mastercard">
                        </ContentBtn>
                    </Btn>
                    <Btn view="btn-type--footer">
                        <ContentBtn>
                            <img class="btn-footer--img" src="/src/assets/img/png/facebook.png" alt="mastercard">
                        </ContentBtn>
                    </Btn>
                    <Btn view="btn-type--footer">
                        <ContentBtn>
                            <img class="btn-footer--img" src="/src/assets/img/png/vk.png" alt="mastercard">
                        </ContentBtn>
                    </Btn>
                    <div class="question-btn--wrapper">
                        <Btn class="question-btn" view="btn-type--footer">
                            <ContentBtn>
                                <p id="text" class="btn-footer--text">Написать нам</p>
                            </ContentBtn>
                        </Btn>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-block--container">
            <div class="icon-and-protected--container">
                <p>YaBao Все праав защищены © 2025</p>
            </div>
            <div class="icon-and-phone--container">
                <div class="icon--container">
                    <img class="credit-card" src="/src/assets/img/png/visa.png" alt="visa">
                    <img class="credit-card" src="/src/assets/img/png/paypal.png" alt="paypal">
                    <img class="credit-card" src="/src/assets/img/png/mastercard.png" alt="mastercard">
                </div>
                <div class="phone-number--container">
                    <p class="number--text">8 499 391-84-49</p>
                    <Btn class="btn--call" view="btn-type--call">
                        <ContentBtn>
                            Заказать звонок
                        </ContentBtn>
                    </Btn>
                </div>
            </div>
        </div>
    </footer>
</template>
<style scoped>
@font-face {
    font-family: "Montserrat-Bold";
    src: url("../../assets/fonts/Montserrat-Bold.ttf") format("ttf");
}

@font-face {
    font-family: "Montserrat-SemiBold";
    src: url("../../assets/fonts/Montserrat-SemiBold.ttf") format("ttf");
}

footer {
    max-width: 1110px;
    margin: 0 auto;
    margin-top: 142px;
}

.media-phone--container {
    display: none;
}

.phone-number--container {
    display: flex;
    flex-direction: column;
    gap: 20px;

    margin-top: -50px;
}

.icon-and-phone--container {
    display: flex;
    gap: 69px;
}

.social-network--wrapper {
    display: flex;
    width: 100%;
    justify-content: space-between;
}

.information--container {
    display: flex;
    justify-content: space-between;

    max-width: 458px;
}

.social-network-and-logo--container {
    display: flex;
    flex-direction: column;
    gap: 33px;

    width: 100%;
    max-width: 545px;
}

.social-net-work-and-information--container {
    display: flex;
    flex-direction: column;
    gap: 23px;
}

.social-net-work--container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.social-net-work--lsit {
    display: flex;
    justify-content: space-between;
}

.question--container {
    display: flex;
    flex-direction: column;
    gap: 33px;

    max-width: 465px;
    margin-top: 25px;
}

.bottom-block--container {
    display: flex;
    justify-content: space-between;
    align-items: center;

    width: 100%;
    max-width: 880px;
    margin-top: 45px;
}

/* text styles */
.question-btn--wrapper {
    width: 100%;
    max-width: 225px;
}

.question-btn {
    width: 100%;
}

.question-icon--container {
    width: 100%;

    display: flex;
    gap: 14px;
    flex-wrap: wrap;
}

.btn-footer--img {
    margin: 11px 36px 11px 35px;
    min-width: 30px;
}

.question-text {
    color: var(--light-black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;

}

.information-title--text-info,
.information-title--text-social {
    color: var(--light-black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
}

.social-net-work--text {
    font-family: "Montserrat-SemiBold", sans-serif;
    color: var(--light-black);
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;

}

.social-net-work--text--addres {
    font-size: 14px;
}

.icon-and-protected--container {
    font-family: "Montserrat-SemiBold", sans-serif;
    color: var(--light-black);
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;

    margin-top: 23px;
}

.icon--container {
    display: flex;
    gap: 23px;
    align-items: center;

}

.number--text {
    color: var(--yellow);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 30px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;

}

@media (max-width:1110px) {
    footer {
        padding: 0 20px;
    }

    .icon--container {
        order: 2;
    }

    .phone-number--container {
        order: 1;
    }

    .phone-number--container {
        margin-top: 0px;
        flex-direction: row;
    }

    .bottom-block--container {
        align-items: start;

        width: 100%;
        max-width: 100%;
        flex-direction: column;
    }

    .icon-and-phone--container {
        order: 1;
    }

    .icon-and-protected--container {
        order: 2;
    }

    .icon-and-phone--container {
        width: 100%;
        justify-content: space-between;
    }

    .social-network-and-logo--container {
        flex-direction: row;
        max-width: 100%;
        padding-right: 83px;
    }

    .social-net-work-and-information--container {
        margin-top: 30px;
    }

    .social-network--wrapper {
        flex-direction: column;
    }

    .question--container {
        max-width: 100%;
    }

    .social-net-work-and-information--container {
        width: 100%;
    }

    .question-btn--wrapper {
        width: 100%;
        max-width: 100%;
    }

    .btn-footer--img {
        margin: 11px 21px;
    }

    .question-icon--container {
        flex-wrap: nowrap;
    }

    .question-icon--container {
        justify-content: space-between;
    }

    .question-text {
        font-size: 12px;
    }
}

@media (max-width:768px) {
    footer {
        padding: 0 10px;
    }

    .social-network-and-logo--container {
        flex-direction: column;
    }

    .phone-number--container {
        display: none;
    }

    .bottom-block--container {
        flex-direction: row;
        align-items: center;
    }

    .btn-footer--img {
        margin: 8px 8px;
    }

    .question-icon--container {
        gap: 0px;
        row-gap: 10px;
        flex-wrap: wrap;
    }

    .information-title--text-info {
        font-size: 10px;
    }

    .information-title--text-social {
        font-size: 12px;
    }

    .social-net-work--text {
        font-size: 10px;
    }

    .question-text {
        font-size: 10px;
    }

    .social-net-work-and-information--container {
        margin-top: 0px;
    }

    .social-network-and-logo--container {
        padding-right: 0px;
    }

    .question--container {
        gap: 15px;
    }

    .icon-and-phone--container {
        order: 2;
        width: 88px;

    }

    .icon-and-protected--container {
        order: 1;
    }

    .credit-card {
        width: 20px;
    }

    .icon--container {
        gap: 8px;
    }

    .icon-and-protected--container {
        margin-top: 0px;
        font-size: 10px;
    }

    .bottom-block--container {
        margin-top: 15px;
    }

    .media-phone--container {
        display: block;

        display: flex;
        flex-direction: column;
        align-items: end;
        gap: 5px;
    }

    .logo--container {
        display: flex;
        justify-content: space-between;
    }

    .number--text {
        font-size: 21px;
    }

    .social-network-and-logo--container {
        gap: 12px;
    }

    .social-net-work-and-information--container {
        gap: 8px;
    }
}
</style>