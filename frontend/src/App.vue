<script setup lang="ts">
import { RouterView, useRoute } from 'vue-router'
import Footer from './components/widgets/Footer.vue';
import Header from "@/components/widgets/Header.vue"
import { computed, provide, ref } from 'vue';
import { system } from "@ankasru/utils-ts"
import HeaderBacket from './components/widgets/HeaderBacket.vue';

const route = useRoute();
const userIsLogin = ref<boolean>(false)
const cookies = system.parseCookies();
provide('userIsLogin', userIsLogin)

const layoutsMap = {
  default: {
    header: Header,
  },
  backet: {
    header: HeaderBacket,
  },
  order: {
    header: HeaderBacket,
  },
}

const layoutComponents = computed(() => layoutsMap[route?.meta?.layoutHeader ?? "default"]);

setInterval(() => {
  if (cookies !== false) {
    cookies.parseCookies()
    userIsLogin.value = cookies.getCookie('session') !== undefined
  }
}, 3000)

</script>
<template>
  <div class="app-container">
    <component :is="layoutComponents?.header" />
    <RouterView class="router-view" />
    <Footer />
  </div>
</template>

<style>
.app-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.router-view {
  flex: 1;
}
</style>
