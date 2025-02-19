<script setup lang="ts">
import { RouterView } from 'vue-router'
import Footer from './components/widgets/Footer.vue';
import Header from "@/components/widgets/Header.vue"
</script>

<template>
  <Header />
  <RouterView />
  <Footer />
</template>

<style scoped>

</style>
