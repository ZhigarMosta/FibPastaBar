<script setup lang="ts"></script>
<template>
    <div class="payment-methods--container">
        <p class="payment-methods--title">Способы оплаты</p>
        <input class="radio--input" type="radio" id="credit-card" checked name="auth">
        <input class="radio--input" type="radio" id="cash" name="auth">
        <label class="radio-label--payment-credit-card" htmlFor="credit-card">
            <div class="radio-customized--container">
                <div class="radio-customized-body"></div>
            </div>
            <img src="../../assets/img/png/PaymentMethodsCreditCard.png" alt="PaymentMethodsCreditCard">
            <p class="radio-label--text">Картой на сайте</p>
        </label>
        <div class="input-and-img--container">
            <div class="input--container">
                <input class="input--number" type="text" name="number" placeholder="Номер карты">
                <input class="input--date" type="text" name="date" placeholder="Годен до">
                <div class="input-password--containe">
                    <input class="input-password--container" :maxlength="3" type="password" name="cvc"
                        placeholder="CVC">
                    <img class="input-password--img" src="../../assets/img/png/cvc.png" alt="cvc">
                </div>
            </div>
            <img class="img-info" src="../../assets/img/png/PaymentInfoImg.png" alt="info">
        </div>
        <label class="radio-label--payment-cash" htmlFor="cash">
            <div class="radio-customized--container">
                <div class="radio-customized-body"></div>
            </div>
            <p class="radio-label--text">Наличными</p>
        </label>
    </div>
</template>
<style scoped>
.img-info {
    width: 275px;
    height: 89px;

}

.input--container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;

    max-width: 322px;
}

.input--number,
.input--date,
.input-password--container {
    border-radius: 7px;
    border: 1.5px solid var(--v4-gray-little-dark);
    background: var(--white);
    padding-left: 18px;
    width: 100%;

    height: 46px;
    color: var(--black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 17px;
    font-style: normal;
    font-weight: 600;
    line-height: 28px;
    opacity: 0.9;
}

.input--number::placeholder,
.input--date::placeholder,
.input-password--container::placeholder {
    opacity: 0.62;
}

.input--number {
    max-width: 322px;
}

.input--date {
    max-width: 202px;
}

.input-password--container {
    max-width: 109px;
}

.input-and-img--container {
    display: flex;
    gap: 28px;

    padding: 22px 0 28px 0;
}

.input-password--img {
    margin-left: -42px;
    margin-top: 15px;
    position: absolute;
}

.payment-methods--title {
    color: var(--yellow);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 28px;
    font-style: normal;
    font-weight: 700;
    line-height: 17px;

    margin-bottom: 38px;
}

.radio-label--text {
    color: var(--v2-light-black);
    font-family: "Montserrat-SemiBold", sans-serif;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 17px;
}

.radio-customized--container {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 19px;
    height: 19px;
    border-radius: 50%;
    border: 2px solid var(--yellow);
}

.radio-customized-body {
    width: 7px;
    height: 7px;
    background-color: var(--yellow);
    border-radius: 50%;
    display: none;
}

.radio-label--payment-credit-card,
.radio-label--payment-cash {
    display: flex;
    gap: 15px;
    align-items: center;
}

#credit-card:checked~.radio-label--payment-credit-card .radio-customized--container .radio-customized-body {
    display: block;
}

#cash:checked~.radio-label--payment-cash .radio-customized--container .radio-customized-body {
    display: block;
}

.payment-methods--container {
    width: 100%;
    max-width: 730px;
    border-radius: 6px;
    background: var(--v7-gray-little-dark);
    padding: 40px 0 40px 30px;
    margin-top: 57px;
}

.radio--input {
    display: none;
}
</style>