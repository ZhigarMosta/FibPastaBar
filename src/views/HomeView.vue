<script setup lang="ts">
import YandexMap from '@/components/shared/YandexMap.vue';
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
  </main>
</template>
<style scoped>
.main {
  margin-top: 142px;
}

.slider--container {
  margin-top: 172px;
}

@media (max-width:1110px) {
  .main {
    margin-top: 80px;
  }

  .slider--container {
    margin-top: 106px;
  }
}

@media (max-width:768px) {
  .slider--container {
    margin-top: 82px;
  }
}
</style>
