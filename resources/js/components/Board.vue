<template>
    <div class="container-fluid">
        <div class="row" id="boardMain">
            <div v-for="article in articles.data" v-bind:key="article.id" class="article col-sm-3" >
                <div id="articleBack">
                    <div class="articleImg">
                        <a :href=article.url><img :src=article.img alt=""></a>
                        <h5><strong>{{ article.date }}</strong></h5>
                        <div id="cat"><a href="#"><img src='/images/shop.svg'></a></div>
                    </div>
                    <div class="articleDes">
                        <h2>{{ article.name }}</h2>
                        <p>{{ article.description }}</p>
                        <h6>{{ article.author}}</h6>
                        <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3>
                        <h3 v-else>Цена не указана.</h3>
                    </div>
                </div>
            </div>


            <pagination :data="articles" @pagination-change-page="getResults"></pagination>

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

<style scoped>
    #paginator{
        margin: 0 auto;
    }

    .paginator{
        margin-top: 20px;
    }

    .btn{
        background-color: #FF6200;
    }

    #boardMain{
        margin: 0;
        margin-top: 10vh;
        padding: 15vh;
        text-align: center;
        min-height: 100vh;
        min-width: 100%;
        color: black;
        background: white;
    }

    #articleBack{
        box-shadow: 0 0 7px;
        min-height: 40vh;
        margin-top: 30px;
    }

    .article{
        width: 100%;
        min-width: 300px;
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

</style>
