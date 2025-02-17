<script setup lang="ts">
import Slider from '@/components/features/Slider.vue';
</script>

<template>
  <main class="main">
    <div class="slider--container">
      <Slider />
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
