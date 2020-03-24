<template>
    <div class="container">
        <div class="row">
            <div class="col-2 filter">
                <div class="filValue">
                    <label>Поиск</label>
                    <b-input-group class="mt-3">
                        <b-form-input v-model="filter.value"></b-form-input>
                    </b-input-group>
                </div>
                <div class="filCategories">
                    <label>Категории</label>
                    <b-form-checkbox v-for="category in categories" :key="category.id"
                            v-model="filter.category"
                            :value="category.name"
                    >
                        {{ category.name }}
                    </b-form-checkbox>
                </div>
                <div class="filPrices">
                    <label>Стоимость</label>
                    <b-form-input id="range-1" v-model="filter.price" type="range" min="0" max="100000"></b-form-input>
                    <label>до {{ filter.price }} Руб.</label>
                </div>
                <div class="filCities">
                    <label>Город</label>
                    <select-comp v-model="filter.city" :data="cities"></select-comp>
                </div>
                <button class="btn btn-info" @click="filtersEnter">применить</button>
            </div>
            
            <div class="col-10 items row" id="boardMain">
                <div v-for="article in articles.data" :key="article.id" class="article col-3">
                    <div id="articleBack">
                        <div class="articleImg">
                            <img :src="article.img">
                            <h5><strong>{{ article.date }}</strong></h5>
                            <div id="cat"><img src='/images/shop.svg'></div>
                        </div>
                        <div class="articleDes">
                            <h2>{{ article.name }}</h2>
                            <p>{{ article.description }}</p>
                            <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3>
                            <h3 v-else>Цена не указана.</h3>
                            <router-link :to="{ name: 'Article', params: { articleId: article.id } }">подробнее</router-link>
                        </div>
                    </div>
                </div>
    
                <div class="paginate">
                    <pagination :data="articles" @pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var cities = require('../../cities');
    // var categories = require('../../categories');
    
    export default {
        props:['filters'],
        name: "SearchPage",
        data(){
            return {
                categories: {},
                cities: cities,
                filter: {
                    price: 100000,
                    category: [],
                    city: '',
                    value: '',
                },
                articles: {},
                FormData: new FormData(),
            }
        },
        mounted() {
            axios.get('/categories')
                .then(response => {
                    this.categories = response.data;
                });
    
            this.filter = this.getFilters();
            this.getResults();
        },
        methods: {
            getResults(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                
                this.FormData.append('name', this.filter.value);
                this.FormData.append('price', this.filter.price);
                this.FormData.append('category', this.filter.category);
                this.FormData.append('city', this.filter.city);
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
                
                axios.post('/filterArticles?page=' + page, this.FormData, config)
                    .then(response => {
                        this.articles = response.data;
                    });
            },
            getFilters(){
                if (Object.keys(this.filters).length !== 0){
                    if (this.filters.category !== undefined){
                        this.filter.category = this.filters.category;
                    }
                    if (this.filters.value !== undefined){
                        this.filter.value = this.filters.value;
                    }
                    if (this.filters.city !== undefined){
                        this.filter.city = this.filters.city;
                    }
                    if (this.filters.price !== undefined){
                        this.filter.price = this.filters.price;
                    }
                }
                
                return this.filter;
            },
            filtersEnter(){
                this.getResults();
            }
        },
    }
</script>

<style scoped>
    .filter{
        background: white;
        color: black;
        font-size: 1.2rem;
        border-right: 1px solid black;
        padding: 10px;
    }
    
    #boardMain{
        margin: 0;
        text-align: center;
        min-height: 100vh;
        color: black;
        background: white;
    }
    
    #articleBack{
        box-shadow: 0 0 7px;
        min-height: 50vh;
        margin-top: 30px;
    }
    
    .article{
        width: 100%;
        min-width: 300px !important;
        min-height: 600px;
    }
    
    .articleDes{
        padding: 15px;
        text-align: left;
    }
    
    .articleImg img{
        width: 100%;
        height: 24vh;
        object-fit: cover;
    }
    
    .articleImg h5{
        text-align: right;
        margin-right: 3%;
        margin-top: -25px;
    }
    
    .articleDes p{
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 5em;
        width: 100%;
    }
    
    .articleDes h2{
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.5em;
        text-overflow: ellipsis;
        width: 100%;
    }
    
    #cat{
        width: 4em;
        height: 4em;
        background: #FF6200;
        border-radius: 50%;
        padding: 2%;
        margin-top: 3em;
        margin-left: 6%;
    }
    
    #cat img{
        width: 3em;
        height: auto !important;
    }
    
    .paginate{
        margin: 3%;
        width: 100%;
    }
</style>