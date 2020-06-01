<template>
    <div class="container-fluid">
        <div class="row map">
            <div id="map" style="width: 100%; height: 500px"></div>
        </div>
    </div>
</template>

<script>
    
    export default {
        props: ['city'],
        name: "Map",
        data() {
            return {
                cityMap: '',
            }
        },
        created(){
            
            let myCity = this.getCity();
            
            this.createdMap(myCity);
            
        },
        updated(){
            if (this.cityMap !== this.city){
                let myCity = this.getCity();
    
                this.createdMap(myCity);
            }
        },
        watch:{
            $route(to, from) {
                if(this.cityMap !== this.$props.city){
                    let myCity = this.getCity();
    
                    this.createdMap(myCity);
                }
            }
        },
        methods:{
            getCity(){
                this.cityMap = this.city;
                return this.city;
            },
            
            createdMap(myCity){
                ymaps.ready(function () {
        
                    var myMap;
                    ymaps.geocode(myCity).then(function (res) {
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
