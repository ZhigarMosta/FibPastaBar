<template>
    <div ref="map" class="yandex-map"></div>
</template>

<script>
export default {
    data() {
        return {
            points: [
                { name: 'Point 1', coords: [55.164441, 61.436843] },
                { name: 'Point 2', coords: [55.160445, 61.398129] },
                { name: 'Point 3', coords: [55.175441, 61.432843] },
            ],
        };
    },
    mounted() {
        window.ymaps.ready(() => {
            this.initMap();
        });
    }
    ,
    methods: {
        initMap() {
            try {
                if (!this.$refs.map) {
                    console.error('Элемент карты не найден');
                    return;
                }

                this.map = new window.ymaps.Map(this.$refs.map, {
                    center: [55.164441, 61.436843],
                    zoom: 10,
                });

                this.map.events.add('actionend', () => {
                    console.log('Перетаскивание завершено');
                });

                this.points.forEach(point => {
                    const placemark = new window.ymaps.Placemark(point.coords, {
                        balloonContent: point.name,
                    });
                    this.map.geoObjects.add(placemark);
                });
            } catch (error) {
                console.error('Ошибка при инициализации карты, или умер ip key:', error);
            }
        }


    },
};
</script>
<style scoped>
.yandex-map {
    width: 100%;
    max-width: 1110px;
    height: 322px;
}

@media (max-width:1110px) {
    .yandex-map {
        padding: 0 15px;
    }
}
</style>
