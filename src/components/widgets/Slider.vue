<script setup lang="ts">
import { onMounted, ref, watch, watchEffect } from "vue";
import emblaCarouselVue from "embla-carousel-vue";
import Autoplay from "embla-carousel-autoplay";
const canScrollPrev = ref(false);
const canScrollNext = ref(false);
const options = { loop: true, dragFree: true };
const [emblaRef, emblaApi] = emblaCarouselVue(options, [
    Autoplay({ playOnInit: true, delay: 10000 })
]);

function scrollNext() {
    emblaApi?.value?.scrollNext();
}
function scrollPrev() {
    emblaApi?.value?.scrollPrev();
}
function updateButtonStates(emblaApi: any) {
    canScrollPrev.value = emblaApi.canScrollPrev();
    canScrollNext.value = emblaApi.canScrollNext();
    selectedScrollIndex.value = emblaApi?.selectedScrollSnap()
}
onMounted(() => {
    if (!emblaApi.value) return;
    updateButtonStates(emblaApi.value);
    emblaApi.value.on("select", updateButtonStates);
});
interface itemsSoloEleventInterface {
    img: string
}
interface itemsDuableEleventInterface {
    firstImg: string,
    secondImg: string
}

const itemsSoloElement = ref<Array<itemsSoloEleventInterface>>([
    { img: "/src/assets/gag/slider/1.png" }, { img: "/src/assets/gag/slider/2.png" }, { img: "/src/assets/gag/slider/3.png" }, { img: "/src/assets/gag/slider/1.png" }, { img: "/src/assets/gag/slider/2.png" }, { img: "/src/assets/gag/slider/3.png" }, { img: "/src/assets/gag/slider/1.png" }, { img: "/src/assets/gag/slider/2.png" }, { img: "/src/assets/gag/slider/3.png" }, { img: "/src/assets/gag/slider/1.png" }, { img: "/src/assets/gag/slider/2.png" }, { img: "/src/assets/gag/slider/3.png" }
])
function transformItems(items: Array<itemsSoloEleventInterface>): Array<itemsDuableEleventInterface> {
    const result: Array<itemsDuableEleventInterface> = [];
    for (let i = 0; i < items.length; i += 2) {
        const firstImg = items[i].img;
        const secondImg = (i + 1 < items.length) ? items[i + 1].img : firstImg;

        result.push({ firstImg, secondImg });
    }
    return result;
}
const itemsDuableElement = ref<Array<itemsDuableEleventInterface>>(transformItems(itemsSoloElement.value));
const selectedScrollIndex = ref(0)
const innerWidth = ref(window.innerWidth)


const autoplay = emblaApi?.value?.plugins()?.autoplay


</script>
<template>
    <section class="embla">
        <div class="embla__viewport" ref="emblaRef">
            <div class="embla__container">
                <div v-if="innerWidth > 768" class="embla__slide" v-for="(item, index) of itemsDuableElement">
                    <div class="embla__slide__number" :class="{ embla_slide__active: selectedScrollIndex == index }">
                        <div class="embla-slide--content"
                            :class="{ embla_slide__active: selectedScrollIndex == index }">
                            <img :src="item.firstImg" alt="img" class="img"
                                :class="{ test_img: selectedScrollIndex !== index }">
                        </div>
                        <div class="embla-slide--content"
                            :class="{ embla_slide__content_active: selectedScrollIndex == index }">
                            <img :src="item.secondImg" class="img" alt="img">
                        </div>
                    </div>
                </div>
                <div v-else class="embla__slide" v-for="(item, index) of itemsSoloElement">
                    <div class="embla__slide__number" :class="{ embla_slide__active: selectedScrollIndex == index }">
                        <div class="embla-slide--content"
                            :class="{ embla_slide__active: selectedScrollIndex == index }">
                            <img :src="item.img" alt="img" class="img"
                                :class="{ test_img: selectedScrollIndex !== index }">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="embla__buttons--container">
            <button @click="scrollPrev" class="embla-btn--wrapper">
                <div class="embla-btn">
                    <img src="/src/assets/img/svg/ArrowBtnSlider.svg" alt="">
                </div>
            </button>
            <button @click="scrollNext" class="embla-btn--wrapper">
                <div class="embla-btn">
                    <img class="left-arrow" src="/src/assets/img/svg/ArrowBtnSlider.svg" alt="">
                </div>
            </button>
        </div>
    </section>
</template>
<style scoped>
.product--img {
    min-width: 540px;
}

.embla {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
    --slide-height: 19rem;
    --slide-spacing: 1rem;
    --slide-size: 100%;
    --slide-spacing-sm: 1.6rem;
    --slide-size-sm: 60%;
    --slide-spacing-lg: 2rem;
    --slide-size-lg: calc(100% / 3);
}

.embla__viewport {
    overflow: hidden;
}

.embla__container {
    display: flex;
}


.embla__slide {
    max-width: 1020px;
    flex: 0 0 var(--slide-size-sm);
    padding-left: 30px;
    padding-right: 30px;

    display: flex;
    align-items: center;
    justify-content: center;
}

.embla__slide__number {
    box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.26);
    border-radius: 13px;
    font-size: 4rem;
    font-weight: 600;

    display: flex;
    gap: 30px;

    user-select: none;
    transition: all 0.5s;
    max-width: 1110px;
    opacity: 0.2;
    transform: scale(0.8);
}

@media (max-width: 1110px) {
    .embla__slide {
        flex: 0 0 var(--slide-size);
        padding-left: 10px;
        padding-right: 10px;
    }

    .embla {
        padding: 0 15px;
    }

    .embla__slide__number {
        display: flex;
        gap: 20px;
    }

    .new--img {
        min-width: 354.5px;
    }
}

@media (max-width: 768px) {
    .embla__slide {
        padding-left: 6px;
        padding-left: 6px;
    }

    .embla__slide__number {
        opacity: 1;
    }

    .img {
        max-width: 213px;
        min-width: 0;
    }

    .embla__slide {
        max-width: 225px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .embla__slide__number {
        transform: scale(1);
    }
}

.embla_slide__active {
    opacity: 1;
    transform: scale(1);
}

.embla-slide--content {
    width: 100%;
    height: 100%;
    max-height: 312px;
    max-width: 540px;

    display: flex;
    justify-content: center;
    align-items: center;
}

.embla__controls {
    display: grid;
    grid-template-columns: auto 1fr;
    justify-content: space-between;
    gap: 1.2rem;
    margin-top: 1.8rem;
}

.embla__buttons--container {
    position: absolute;
    display: flex;
    justify-content: space-between;

    width: 100%;
    max-width: 1292px;
    padding: 0 35px;
}

.embla-btn--wrapper {
    display: flex;
    align-items: center;
    justify-content: center;

    width: 30px;
    height: 30px;
    background-color: var(--yellow);
    border-radius: 50%;
}

.left-arrow {
    transform: rotate(180deg);
}

.embla-btn {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>