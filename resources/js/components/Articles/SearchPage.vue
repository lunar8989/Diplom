<template>
    <div class="container">
        <div class="row">
            <div class="filter col-lg-2">
                <div class="filValue">
                    <b-form-input v-model="filter.value"></b-form-input>
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
                    <b-form-input v-model="filter.price" type="text"></b-form-input>
                    <b-form-input id="range-1" v-model="filter.price" type="range" min="0" max="100000"></b-form-input>
                    <span>до {{ filter.price }} Руб.</span>
                </div>
                <div class="filCities">
                    <label>Город</label>
                    <select-comp v-model="filter.city" :data="cities"></select-comp>
                </div>
            </div>
            
            <div class="top_filter_form col-12">
                <div class="top_filter_form_search">
                    <b-input-group>
                        <b-input-group-prepend>
                            <b-button variant="outline-info">Поиск</b-button>
                        </b-input-group-prepend>
                        
                        <b-form-input type="text" v-model="filter.value"></b-form-input>
                    </b-input-group>
                </div>
                
                <div class="top_filter_form_more">
                    <b-button variant="danger" @click="showModalFilterForm">Фильтры</b-button>
                </div>
                <b-modal id="modal-scoped" title="Фильтрация объявлений" style="color: black">
                    <b-form>
                        <b-form-group label="Название" label-for="modal-form-name">
                            <b-form-input
                                    id="modal-form-name"
                                    size="lg"
                                    v-model="filter.value"
                            ></b-form-input>
                        </b-form-group>
            
                        <b-form-group label="Категория" label-for="modal-form-category">
                            <select-comp
                                    id="modal-form-category"
                                    v-model="filter.category"
                                    :data="categories">
                            </select-comp>
                        </b-form-group>
            
                        <b-form-group label="Город" label-for="modal-form-city">
                            <select-comp
                                    id="modal-form-city"
                                    v-model="filter.city"
                                    :data="this.cities"
                            ></select-comp>
                        </b-form-group>
    
                        <b-form-group label="Стоимость" label-for="modal-form-price">
                            <b-form-input
                                    id="modal-form-price"
                                    size="lg"
                                    v-model="filter.price"
                            ></b-form-input>
                        </b-form-group>
                    </b-form>
        
                    <template v-slot:modal-footer="{ok}">
                        <b-button size="md" variant="success" @click="$bvModal.hide('modal-scoped')">
                            Применить
                        </b-button>
                    </template>
                </b-modal>
            </div>
            
            <div class="col-12 col-lg-10" id="boardMain">
                <board :filters="this.filter"></board>
            </div>
        </div>
    </div>
</template>

<script>
    import board from '../Articles/Board';
    var cities = require('../../cities');
    
    export default {
        components:{
            board,
        },
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
            }
        },
        mounted() {
            axios.get('/categories')
                .then(response => {
                    this.categories = response.data;
                });
    
            this.filter = this.getFilters();
        },
        methods: {
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
            showModalFilterForm(){
                this.$bvModal.show('modal-scoped');
            }
        },
    }
</script>

<style scoped lang="scss">
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

    .articleImg{
        height: 30vh;
        overflow: hidden;
        img{
            width: 100%;
            object-position: top;
            object-fit: cover;
            height: 100%;
        }
    }

    .cat_date{
        margin: 2vh 6% 0 6%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        span{
            font-size: 18px;
        }
    }

    .articleDes {
        padding: 15px;
        text-align: left;
        p{
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 5em;
            width: 100%;
        }
    
        h2{
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.5em;
            text-overflow: ellipsis;
            width: 100%;
        }
        hr{
            margin: 5px;
            color: gray;
            border: 1px solid;
        }
    }

    #cat{
        width: 4em;
        background: #FF6200;
        border-radius: 50%;
        padding: 2%;
        img{
            width: 90%;
            height: auto !important;
        }
    }
    
    .top_filter_form{
        display: none;
        background-color: #fff;
        border-bottom: 1px solid black;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
    }

    .paginate{
        margin: 3%;
        width: 100%;
        font-size: 24px !important;
    }

    @media(max-width: 992px){
        .filter{
            display: none;
        }
        
        .top_filter_form{
            display: flex;
        }
    }
</style>