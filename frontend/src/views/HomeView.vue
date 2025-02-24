<script setup lang="ts">
import BacketBtn from '@/components/features/BacketBtn.vue';
import YandexMap from '@/components/shared/YandexMap.vue';
import Product from '@/components/widgets/Product.vue';
import Slider from '@/components/widgets/Slider.vue';

</script>

<template>
  <main class="main">
    <div class="slider--container">
      <Slider />
    </div>
    <div class="yandex-map--container">
      <YandexMap />
    </div>
    <div class="prodcts--container">
      <Product />
    </div>
    <BacketBtn view="body" class="btn--backet" />
  </main>
</template>
<style scoped>
.main {
  margin-top: 142px;
  height: calc(100% - 342px + 142px);
}

.slider--container {
  margin-top: 172px;
}

.yandex-map--container,
.prodcts--container {
  display: flex;
  justify-content: center;
  margin-top: 50px;
}

.btn--backet {
  position: fixed;
  bottom: 10px;
  right: 10px;

  display: none;
}

@media (max-width:1110px) {
  .main {
    margin-top: 80px;
    height: calc(100% - 342px + 80px);
  }

  .slider--container {
    margin-top: 106px;
  }
}

@media (max-width:768px) {
  .slider--container {
    margin-top: 82px;
  }

  .btn--backet {
    position: fixed;
    bottom: 10px;
    right: 10px;

    display: flex;
  }
}
</style>
