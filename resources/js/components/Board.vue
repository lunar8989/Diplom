<template>
    <div class="container-fluid">
        <div class="row" id="boardMain">
            <div v-for="article in articles.data" v-bind:key="article.id" class="article col-sm-3">
                <div id="articleBack">
                    <div class="articleImg">
                        <a :href=article.url><img :src=article.img alt=""></a>
                        <h5><strong>{{ article.date }}</strong></h5>
                        <div id="cat"><a href="#"><img src='/images/shop.svg'></a></div>
                    </div>
                    <div class="articleDes">
                        <h2>{{ article.name }}</h2>
                        <p>{{ article.description }}</p>
                        <h6>{{ article.autor}}</h6>
                        <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3>
                        <h3 v-else>Цена не указана.</h3>
                    </div>
                </div>
            </div>

            <pagination :data="articles" @page-paginate="getResults"></pagination>
            
            <!-- <div class="btn-toolbar col-sm-12 paginator">
                <div class="btn-group" id="paginator">
                    <button class="btn btn-primary" v-for="p in pagination.pages" v-bind:key="p.id" @click.prevent="setPage(p)">
                        {{ p }}
                    </button>
                </div>
            </div> -->
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return{
            // perPage: 12,
            // pagination:{},
            articles: {},
            // data: [
            //     {name: 'lfsaf1', img: '../images/dogtest.jpg', description: 'hfgjhfshf gshjshsfdhahfhfdhs fdhbfhdfhhfg jhfshfgshjsh sfdhahfhf bfhdf hhfgjhfshfgshjshsfd hahfhfdhsfdhb fhdfhhfgjhfshfgshj hsfdhahfhfdhs fdhbfhdfhhfgjhfshf shjshsfd ahfhfdhsfdh bfhdfhhfgjhfshf gshjshs fdhahfhfdh sfdhbfhdfh', price: '21564', date: '20.04.2016'},
            //     {name: 'lfsaf2', img: '../images/dogtest.jpg', description: 'ghklujl', price: '546546', date: '20.04.2016'},
            //     {name: 'lfsaf3', img: '../images/dogtest.jpg', description: 'jhgdj', price: '45656', date: '20.04.2016'},
            //     {name: 'lfsaf4', img: '../images/dogtest.jpg', description: 'zdgfd', price: '54654', date: '20.04.2016'},
            //     {name: 'lfsaf5', img: '../images/dogtest.jpg', description: 'vczb', price: '', date: '20.04.2016'},
            //     {name: 'lfsaf6', img: '../images/dogtest.jpg', description: 'zdfgzd', price: '534', date: '20.04.2016'},
            //     {name: 'lfsaf7', img: '../images/dogtest.jpg', description: 'zdfgzdfg', price: '4568', date: '20.04.2016'},
            //     {name: 'lfsaf8', img: '../images/dogtest.jpg', description: 'hgjfg', price: '8467', date: '20.04.2016'},
            //     {name: 'lfsaf1', img: '../images/dogtest.jpg', description: 'hfgjhfshf gshjshsfdhahfhfdhs fdhbfhdfhhfg jhfshfgshjsh sfdhahfhf bfhdf hhfgjhfshfgshjshsfd hahfhfdhsfdhb fhdfhhfgjhfshfgshj hsfdhahfhfdhs fdhbfhdfhhfgjhfshf shjshsfd ahfhfdhsfdh bfhdfhhfgjhfshf gshjshs fdhahfhfdh sfdhbfhdfh', price: '21564', date: '20.04.2016'},
            //     {name: 'lfsaf2', img: '../images/dogtest.jpg', description: 'ghklujl', price: '546546', date: '20.04.2016'},
            //     {name: 'lfsaf3', img: '../images/dogtest.jpg', description: 'jhgdj', price: '45656', date: '20.04.2016'},
            //     {name: 'lfsaf4', img: '../images/dogtest.jpg', description: 'zdgfd', price: '54654', date: '20.04.2016'},
            //     {name: 'lfsaf5', img: '../images/dogtest.jpg', description: 'vczb', price: '', date: '20.04.2016'},
            //     {name: 'lfsaf6', img: '../images/dogtest.jpg', description: 'zdfgzd', price: '534', date: '20.04.2016'},
            //     {name: 'lfsaf7', img: '../images/dogtest.jpg', description: 'zdfgzdfg', price: '4568', date: '20.04.2016'},
            //     {name: 'lfsaf8', img: '../images/dogtest.jpg', description: 'hgjfg', price: '8467', date: '20.04.2016'},
            //     {name: 'lfsaf1', img: '../images/dogtest.jpg', description: 'hfgjhfshf gshjshsfdhahfhfdhs fdhbfhdfhhfg jhfshfgshjsh sfdhahfhf bfhdf hhfgjhfshfgshjshsfd hahfhfdhsfdhb fhdfhhfgjhfshfgshj hsfdhahfhfdhs fdhbfhdfhhfgjhfshf shjshsfd ahfhfdhsfdh bfhdfhhfgjhfshf gshjshs fdhahfhfdh sfdhbfhdfh', price: '21564', date: '20.04.2016'},
            //     {name: 'lfsaf2', img: '../images/dogtest.jpg', description: 'ghklujl', price: '546546', date: '20.04.2016'},
            //     {name: 'lfsaf3', img: '../images/dogtest.jpg', description: 'jhgdj', price: '45656', date: '20.04.2016'},
            //     {name: 'lfsaf4', img: '../images/dogtest.jpg', description: 'zdgfd', price: '54654', date: '20.04.2016'},
            //     {name: 'lfsaf5', img: '../images/dogtest.jpg', description: 'vczb', price: '', date: '20.04.2016'},
            //     {name: 'lfsaf6', img: '../images/dogtest.jpg', description: 'zdfgzd', price: '534', date: '20.04.2016'},
            //     {name: 'lfsaf7', img: '../images/dogtest.jpg', description: 'zdfgzdfg', price: '4568', date: '20.04.2016'},
            //     {name: 'lfsaf8', img: '../images/dogtest.jpg', description: 'hgjfg', price: '', date: '20.04.2016'},
            // ],
        }
    },
    mounted() {
		this.getResults();
	},

	methods: {
		getResults(page = 1) {
			axios.get('/articles?page=' + page)
				.then(response => {
					this.articles = response.data;
			    });
		}
	},
    // computed:{
    //     collection(){
    //         return this.paginate(this.data);
    //     }
    // },
    // methods: {
    //     setPage(p){
    //         this.pagination = this.paginator(this.data.length, p);
    //     },
    //     paginate(data){
    //         return _.slice(data, this.pagination.startIndex, this.pagination.endIndex + 1);
    //     },
    //     paginator(totalItems, currentPage){
    //         var startIndex = (currentPage - 1) * this.perPage,
    //         endIndex = Math.min(startIndex + this.perPage - 1, totalItems - 1);

    //         return{
    //             currentPage: currentPage,
    //             startIndex: startIndex,
    //             endIndex: endIndex,
    //             pages: _.range(1, Math.ceil(totalItems / this.perPage) + 1)
    //         };
    //     }
    // },

    // created() {
    //     this.setPage(1);
    //     // axios.get('/articles?page' = this.p)  
    //     //     .then(response => {
    //     //         this.data = response.data;
    //     //     });
    // }
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
        color: black;
        background: white;
    }

    #articleBack{
        box-shadow: 0 0 7px;
        height: 50vh;
        margin-top: 30px;
    }

    .article{
        width: 100%;
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
        padding: 2.5%;
        margin-left: 6%;
    }

    #cat img{
        width: 3em;
    }
</style>
