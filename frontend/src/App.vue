<script setup lang="ts">
import { RouterView } from 'vue-router'
import Footer from './components/widgets/Footer.vue';
import Header from "@/components/widgets/Header.vue"
import { provide, ref } from 'vue';
import { system } from "@ankasru/utils-ts"

const userIsLogin = ref<boolean>(false)
provide('userIsLogin', userIsLogin)

const cookies = system.parseCookies();

setInterval(() => {
  if (cookies !== false) {
    cookies.parseCookies()
    userIsLogin.value = cookies.getCookie('session') !== undefined
  }
}, 3000)
</script>

<template>
  <Header />
  <RouterView />
  <Footer />
</template>

<style scoped></style>
