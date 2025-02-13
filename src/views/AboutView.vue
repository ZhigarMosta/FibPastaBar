<script setup lang="ts">
import Btn from "@/components/features/Btn.vue"
import ProductCard from "@/components/features/ProductCard.vue";
import ProductNew from "@/components/features/ProductNew.vue";
import ContentBtn from "@/components/shared/ContentBtn.vue"
import Footer from "@/components/widgets/Footer.vue";
</script>
<template>
  <Btn view="btn-type--pizza">
    <ContentBtn>
      в карзину
    </ContentBtn>
  </Btn>

  <br />

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

  <br />

  <Btn view="btn-type--addres-and-order">
    <ContentBtn view="content-type--apply-order">
      <template #text>
        Оформить заказ
      </template>
      <template #count>
        {{ 1048 }}
      </template>
    </ContentBtn>
  </Btn>

  <br />

  <Btn view="btn-type--addres-and-order">
    <ContentBtn view="content-type--apply-order">
      <template #text>
        Оформить заказ
      </template>
    </ContentBtn>
  </Btn>

  <br />

  <Btn view="btn-type--stock">
    <ContentBtn>
      Все акции
    </ContentBtn>
  </Btn>

  <br />

  <Btn view="btn-type--addres-and-order">
    <ContentBtn>
      Поддтвердить адрес
    </ContentBtn>
  </Btn>

  <br />

  <Btn view="btn-type--send">
    <ContentBtn>
      Отправить
    </ContentBtn>
  </Btn>

  <br />

  <Btn view="btn-type--footer">
    <ContentBtn>
      написать нам
    </ContentBtn>
  </Btn>

  <br />

  <Btn view="btn-type--look">
    <ContentBtn>
      написать нам
    </ContentBtn>
  </Btn>

  <br />

  <Btn view="btn-type--call">
    <ContentBtn>
      написать нам
    </ContentBtn>
  </Btn>

  <ProductCard img="/src/assets/gag/pizza.png" name-pizza="С креветками и трюфелями" :is-new="true"
    dec="Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г"
    :price="500" />
  <br />
  <ProductNew img="/src/assets/gag/pizza.png" :price="500" name-pizza="Карбонара" />
  <!-- <Footer /> -->
</template>
<style></style>
