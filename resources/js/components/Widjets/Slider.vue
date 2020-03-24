<template>
    <div class="container-fluid">
        <div class="row">
            <div class="swiper-container premium">
                <div class="swiper-wrapper">
                    <div v-for="article in articles" v-bind:key="article.id" class="swiper-slide slide">
                        <div class="slideImg">
                            <img :src=article.img alt="">
                            <h5><strong>{{ article.date }}</strong></h5>
                            <div id="cat"><a><img src='/images/shop.svg'></a></div>
                        </div>
                        <div class="slideDes">
                            <h2>{{ article.name }}</h2>
                            <p>{{ article.description }}</p>
                            <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3> 
                            <h3 v-else>Цена не указана.</h3>
                            <router-link :to="{ name: 'Article', params: { articleId: article.id } }">подробнее</router-link>
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
            articles: [{}],
        }
    },
    mounted() {
        var swiper = new Swiper('.premium', {
            slidesPerView: 4,
            spaceBetween: 25,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    
        axios.get('/articlesPremium')
            .then(response => {
                this.articles = response.data;
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
        width: 100%;
        min-width: 300px !important;
        min-height: 600px;
        box-shadow: 0 0 7px;
    }

    .slideDes{
        padding: 15px;
        text-align: left;
    }

    .slideImg img{
        width: 100%;
        height: 24vh;
        object-fit: cover;
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

    .slideDes h2{
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
</style>