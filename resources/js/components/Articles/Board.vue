<template>
    <div class="container-fluid">
        <div class="row" id="boardMain">
            <div v-for="(article, index) in articles.data" :key="index"
                 class="article col-12 col-sm-6 col-md-4 col-lg-3">
                <div id="articleBack">
                    <div class="articleImg">
                        <img :src="article.img">
                    </div>
                    <div class="cat_date">
                        <div class="cat">
                            <img src="/images/shop.svg">
                        </div>
                        <span>{{ article.date }}</span>
                    </div>
                    
                    <div class="articleDes">
                        <h2>{{ article.name }}</h2>
                        <hr style="">
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
</template>

<script>

export default {
    props: ['filters'],
    data() {
        return{
            articles: {},
            categories: {},
            filter: {
                price: 100000,
                category: [],
                city: '',
                value: '',
            },
            FormData: new FormData(),
        }
    },
    watch: {
        filters:{
            handler: function (val, oldVal) {
                this.filter = this.getFilters(val);
                this.getResults();
            },
            deep: true,
        }
    },
    mounted() {
        axios.get('/categories')
            .then(response => {
                this.categories = response.data;
            });
        
        this.filter = this.getFilters(this.filters);
        this.getResults();
	},
	methods: {
        getResults(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }
            
            this.FormData.set('name', this.filter.value);
            this.FormData.set('price', this.filter.price);
            this.filter.category.forEach((item) => {
                this.FormData.append('category[]', item);
            });
            this.FormData.set('city', this.filter.city);
            
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
        getFilters(val){
            if (Object.keys(val).length !== 0){
                if (val.category !== undefined){
                    this.filter.category = val.category;
                }
                if (val.value !== undefined){
                    this.filter.value = val.value;
                }
                if (val.city !== undefined){
                    this.filter.city = val.city;
                }
                if (val.price !== undefined){
                    this.filter.price = val.price;
                }
            }
            return this.filter;
        },
	},
}
</script>

<style scoped lang="scss">
    #boardMain{
        margin: 0;
        text-align: center;
        min-height: 100vh;
        min-width: 100%;
        color: black;
        background: white;
    }

    #articleBack{
        box-shadow: 0 0 7px;
        min-height: 50vh;
        margin-top: 30px;
    }

    .article{
        min-height: 500px;
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

    .cat{
        width: 4em;
        background: #FF6200;
        border-radius: 50%;
        padding: 2%;
        img{
            width: 90%;
            height: auto !important;
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
    
    .paginate{
        margin: 3%;
        width: 100%;
        font-size: 24px !important;
    }
</style>
