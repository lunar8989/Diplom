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
                    <div class="row no-gutters" style="padding: 1.8%">
                        <div class="col-sm-3 itemMenu"><select-comp :options="categories"></select-comp></div>
                        <div class="col-sm-3 itemMenu"><select-comp :options="country"></select-comp></div>
                        <div class="col-sm-3 itemMenu"><select-comp></select-comp></div>
                        <div class="col-sm-3 itemMenu"><search-comp :searchShow="true"></search-comp></div>
                    </div>
                </div>

            </div>

            <div id="categoryHeader" class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div v-for="cat in categories" v-bind:key="cat.id" class="col-sm-2 category">
                            <a :href=cat.url><img :src=cat.img /></a>
                            <p>{{ cat.name }}</p>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sliderPremium row">
            <h1 id="sliderPremiumTitle">Premium объявления</h1>
            <slider-comp></slider-comp>
        </div>

        <div class="row board">
            <board-comp></board-comp>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return{
                country: [
                    {name: 'russia'},
                    {name: 'USA'},
                ],
                categories: [
                    {name: 'Кошки', img: '../images/cat.svg'},
                    {name: 'Собаки', img: '../images/dog.svg'},
                    {name: 'Птицы', img: '../images/bird.svg'},
                    {name: 'Магазин', img: '../images/shop.svg'},
                    {name: 'Профиль', img: '../images/profile.svg'}
                ]
            }
        },
    }
</script>

<style>
    .board{
        width: 100%;
        margin: 0;
    }

    #contentHeader{
        min-height: 700px;
        margin-left: 0;
        margin-right: 0;
        margin-top: 20em;
        margin-bottom: 15em;
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

    #sliderPremiumTitle{
        border-left: 4px solid #FF6200;
        margin-bottom: 5%;
        font-size: 40px;
    }


</style>
