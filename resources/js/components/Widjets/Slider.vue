<template>
    <div class="container-fluid">
        <div class="row">
            <div class="swiper-container premium">
                <div class="swiper-wrapper">
                    <div v-for="article in articles" v-bind:key="article.id" class="swiper-slide slide">
                        <div class="slideImg">
                            <a :href=article.url><img :src=article.img alt=""></a>
                            <h5><strong>{{ article.date }}</strong></h5>
                            <div id="cat"><a href="#"><img src='/images/shop.svg'></a></div>
                        </div>
                        <div class="slideDes">
                            <h2>{{ article.name }}</h2>
                            <p>{{ article.description }}</p>
                            <h6>{{ article.autor}}</h6>
                            <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3> 
                            <h3 v-else>Цена не указана.</h3>
                        </div>                       
                    </div>
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            articles: [
                {name: 'lfsaf', img: '../images/dogtest.jpg', description: 'hfgjhfshf gshjshsfdhahfhfdhs fdhbfhdfhhfg jhfshfgshjsh sfdhahfhf bfhdf hhfgjhfshfgshjshsfd hahfhfdhsfdhb fhdfhhfgjhfshfgshj hsfdhahfhfdhs fdhbfhdfhhfgjhfshf shjshsfd ahfhfdhsfdh bfhdfhhfgjhfshf gshjshs fdhahfhfdh sfdhbfhdfh', price: '21564', date: '20.04.2016'},
                {name: 'lfsaf2', img: '../images/dogtest.jpg', description: 'ghklujl', price: '546546', date: '20.04.2016'},
                {name: 'lfsaf3', img: '../images/dogtest.jpg', description: 'jhgdj', price: '45656', date: '20.04.2016'},
                {name: 'lfsaf4', img: '../images/dogtest.jpg', description: 'zdgfd', price: '54654', date: '20.04.2016'},
                {name: 'lfsaf5', img: '../images/dogtest.jpg', description: 'vczb', price: '', date: '20.04.2016'},
                {name: 'lfsaf6', img: '../images/dogtest.jpg', description: 'zdfgzd', price: '534', date: '20.04.2016'},
                {name: 'lfsaf7', img: '../images/dogtest.jpg', description: 'zdfgzdfg', price: '4568', date: '20.04.2016'},
                {name: 'lfsaf8', img: '../images/dogtest.jpg', description: 'hgjfg', price: '8467', date: '20.04.2016'},
            ],
        }
    },
    mounted: function () {
        var swiper = new Swiper('.premium', {
            slidesPerView: 4,
            spaceBetween: 25,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
    },
}
</script>

<style scoped>

    .swiper-button-next, .swiper-button-prev{
        color: #FF6200;
    }

    .premium{
        text-align: center;
        width: 100%;
        min-height: 40vh;
        color: black;
        padding: 15px;
    }

    .slide{
        box-shadow: 0 0 7px;
    }

    .slideDes{
        padding: 15px;
        text-align: left;
    }

    .slideImg img{
        width: 100%;
        max-height: 40vh;
    }

    .slideImg h5{
        text-align: right;
        margin-right: 3%;
        margin-top: -25px;
    }

    .slideDes p{
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