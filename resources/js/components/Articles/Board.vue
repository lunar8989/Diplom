<template>
    <div class="container-fluid">
        <div class="row" id="boardMain">
            <div v-for="article in articles.data" v-bind:key="article.id" class="article col-sm-3" >
                <div id="articleBack">
                    <div class="articleImg">
                        <img :src=article.img>
                        <h5><strong>{{ article.date }}</strong></h5>
                        <div id="cat"><a href="#"><img src='/images/shop.svg'></a></div>
                    </div>
                    <div class="articleDes">
                        <h2>{{ article.name }}</h2>
                        <p>{{ article.description }}</p>
                        <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3>
                        <h3 v-else>Цена не указана.</h3>
                        <router-link :to="{ name: 'Article', params: { id: article.id } }">подробнее</router-link>
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
    data() {
        return{
            articles: {},
        }
    },
    mounted() {
		this.getResults();
	},

	methods: {
		getResults(page) {
            if (typeof page === 'undefined') {
                page = 1;
            }

			axios.get('/articles?page=' + page)
                .then(response => {
                    this.articles = response.data;
                });
		}
	},
}
</script>

<style>
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
        width: 100%;
        min-width: 300px !important;
    }

    .articleDes{
        padding: 15px;
        text-align: left;
    }

    .articleImg img{
        width: 100%;
        max-height: 40vh;
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
    }
    
    .paginate{
        margin: 3%;
        width: 100%;
    }
    

</style>
