<template>
    <div class="container-fluid">
        <div class="row map">
            <div id="map" style="width: 100%; height: 700px;"></div>
        </div>
    </div>
</template>

<script>
    
    
    export default {
        props: ['city'],
        name: "Map",
        data() {
            return {
            
            }
        },
        created(){
            
            let myCity = this.getCity();
            
            ymaps.ready(function () {
                
                var myMap;
                ymaps.geocode(myCity)
                    .then(function (res) {
                        myMap = new ymaps.Map('map', {
                            center: res.geoObjects.get(0)
                                .geometry.getCoordinates(),
                            zoom: 15
                        });
                        myMap.controls.add(
                            new ymaps.control.ZoomControl()
                        );
                        myMap.controls.add('typeSelector');
                    });
            });
    
            
        },
        methods:{
            getCity(){
                return this.city;
            }
        },
        
    }
</script>

<style scoped>
    .map{
        background-color: white;
        color: black;
        padding: 10px;
        border: 1px solid black;
    }
</style>
