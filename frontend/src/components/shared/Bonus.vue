<script setup lang="ts"></script>
<template>
    <input class="bonus--input" type="checkbox" id="bonus" checked>
    <label class="bonus--label" htmlFor="bonus">
        <div class="checkbox-customized">
            <div class="checkbox-customized-body"></div>
        </div>
        <p class="bonus--text">Сообщать о бонусах, акциях и новых продуктах <span
                class="bonus-info--text-span">i</span>
        </p>
    </label>
</template>
<style scoped>
.bonus--input {
    display: none;
}

.checkbox-customized {
    width: 19px;
    height: 19px;
    border-radius: 3px;
    border: 2px solid var(--yellow);

    display: flex;
    justify-content: center;
    align-items: center;
}

.checkbox-customized-body {
    width: 7px;
    height: 7px;
    background-color: var(--yellow);
    border-radius: 50%;
    display: none;
}

.bonus--label {
    display: flex;
    gap: 20px;
    align-items: center;

    margin-top: 33px;
}

#bonus:checked~.bonus--label .checkbox-customized .checkbox-customized-body {
    display: block;
}

.bonus-info--text-span {
    padding: 0 10px;
    border-radius: 50%;
    background-color: var(--v8-gray-little-dark);

    font-size: 14px;
    margin-left: 20px;

}

.bonus--text {
    color: var(--black);
    font-family: "Montserrat-Bold", sans-serif;
    font-size: 15px;
    font-style: normal;
    font-weight: 700;
    line-height: 28px;
    opacity: 0.7;

    width: 100%;
}
</style>