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

            <div class="col-12">
                <div id="settingsBarHeader" class="container ">
                    <div class="row no-gutters" style="padding: 2%">
                        <div class="col-4 itemMenu"><select-comp v-model="search.category" :data="categories"></select-comp></div>
                        <div class="col-4 itemMenu"><select-comp v-model="search.city" :data="cities"></select-comp></div>
                        <div id="searchBox" class="col-4">
                            <input class="col-10 searchInput"  type="text" v-model="search.value" placeholder="Поиск..">
                            <button @click="searching" class="col-2" id="btnSearch" type="button">
                                <i class="fa fa-search fa-2x" aria-hidden="true" style="color: white;"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="categoryHeader" class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div v-for="cat in categories" :key="cat.id" v-if="cat.id < 5" class="col-2 category">
                            <router-link :to="{ name: 'Searching', params: { filters: { category:  [cat.name], value: '', city: '' }}}"><img :src=cat.img /></router-link>
                            <p>{{ cat.name }}</p>
                        </div>
                        <div class="col-2 category">
                            <router-link :to="{ name: 'Dashboard', params: { userId: this.user.id } }"><img src="../../img/profile.svg"></router-link>
                            <p>личный кабинет</p>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sliderPremium row">
            <h1 class="sliderPremiumTitle">Premium объявления</h1>
            <slider></slider>
        </div>

        <div class="row board">
            <h1 class="sliderPremiumTitle">Последние объявления</h1>
            <board></board>
        </div>
        
        <div class="row map">
            <h1 class="sliderPremiumTitle">Объявления на карте</h1>
            <map-comp :city="city" style="border: 1px solid black"></map-comp>
        </div>
        
    </div>
</template>

<script>

    import slider from './Widjets/Slider'
    import board from './Articles/Board'
    import search from './Widjets/Search'
    var cities = require('../cities');
    
    export default {
        components:{
            slider,
            search,
            board,
        },
        data(){
            return{
                city: 'Омск',
                cities: cities,
                categories: {},
                user: {},
                search:{
                    category: [],
                    city: '',
                    value: '',
                }
            }
        },
        
        created() {
            axios.get('/categories')
                .then(response => {
                    this.categories = response.data;
                });
            axios.get('/authUser').then(response => {
                this.user = response.data;
            });
            
        },
        
        methods:{
            searching() {
                this.$router.push({ name: 'Searching', params: {
                    filters: {
                        category: this.search.category,
                        value: this.search.value,
                        city: this.search.city,
                    }}});
            }
        }
    }
</script>

<style scoped>
    .board{
        width: 100%;
        margin: 0;
        background-color: white;
        margin-top: 10vh;
        padding: 15vh;
    }
    
    .map{
        background-color: white;
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
        color: white;
        text-decoration: none;
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

    #searchBox{
        padding: 0;
    }

    .searchInput{
        height: 50px;
        float: left;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .searchInput:focus{
        outline: none;
        border-bottom: 2px solid #FF6200;
    }

    #btnSearch{
        padding: 5px;
        height: 50px;
        background-color: #FF6200;
        border: none;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #btnSearch:hover{
        background-color: gray;
    }
</style>
