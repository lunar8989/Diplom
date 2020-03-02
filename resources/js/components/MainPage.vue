<template>
    <div class="container-fluid">
        <div id="contentHeader" class="row">
            <div id="headerTitle" class="container">

                <div class="row">
                    <center class="col">
                        <h1 style="font-size: 60px">Дай лапу</h1>
                        <h5>Возможность быстро найти питомцу дом</h5>
                    </center>
                </div>
            </div>

            <div class="col-md-12">
                <div id="settingsBarHeader" class="container ">
                    <div class="row no-gutters" style="padding: 2%">
                        <div class="col-sm-3 itemMenu"><select-comp :data="categories"></select-comp></div>
                        <div class="col-sm-3 itemMenu"><select-comp :data="regions"></select-comp></div>
                        <div class="col-sm-3 itemMenu"><select-comp :data="cities"></select-comp></div>
                        <div class="col-sm-3 itemMenu"><search-comp :searchShow="true"></search-comp></div>
                    </div>
                </div>
            </div>

            <div id="categoryHeader" class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div v-for="cat in categories" v-bind:key="cat.id" v-if="cat.id < 6" class="col-sm-2 category">
                            <a :href=cat.url><img :src=cat.img /></a>
                            <p>{{ cat.name }}</p>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sliderPremium row">
            <h1 class="sliderPremiumTitle">Premium объявления</h1>
            <slider-comp></slider-comp>
        </div>

        <div class="row board">
            <h1 class="sliderPremiumTitle">Последние объявления</h1>
            <board-comp></board-comp>
        </div>
        
        <div class="row map">
            <h1 class="sliderPremiumTitle">Объявления на карте</h1>
            <map-comp></map-comp>
        </div>
        
    </div>
</template>

<script>

    export default {

        data(){
            return{
                cities: {},
                regions: {},
                categories: {},
            }
        },
        mounted() {
            axios.get('/cities')
                .then(response => {
                    this.cities = response.data;
                });
            axios.get('/regions')
                .then(response => {
                    this.regions = response.data;
                });
            axios.get('/categories')
                .then(response => {
                    this.categories = response.data;
                });
        }
    }
</script>

<style>
    .board{
        width: 100%;
        margin: 0;
        background-color: white;
        margin-top: 10vh;
        padding: 15vh;
    }
    
    .map{
        background-color: white;
        margin-top: 5vh;
        padding: 3%;
    }

    #contentHeader{
        min-height: 700px;
        margin-left: 0;
        margin-right: 0;
        margin-top: 5vh;
        margin-bottom: 35vh;
    }

    #headerTitle{
        max-height: 100px !important;
    }

    #settingsBarHeader{
        background-color: white;
    }

    #categoryHeader{
        color: white;
    }

    .category{
        text-align: center;
    }

    .category img{
        width: 40%;
    }

    .category:hover{
        background-color: #FF6200;
    }

    .sliderPremium{
        background-color: white;
        color: black;
        padding: 3% 8% 3% 8%;
    }

    .sliderPremiumTitle{
        border-left: 4px solid #FF6200;
        margin-bottom: 5%;
        font-size: 40px;
        color: black;
    }

    .itemMenu{
        height: 50px;
    }
</style>
