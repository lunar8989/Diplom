<template>
    <div class="container-fluid">
        <div class="row">
            <div class="swiper-container premium">
                <div class="swiper-wrapper">
                    <div v-for="article in articles" v-bind:key="article.id" class="swiper-slide slide">
                        <div class="slideImg">
                            <a :href=article.url><img :src=article.img alt=""></a>
                            <h6>{{ article.date }}</h6>
                            <img src='' >
                        </div>
                        <div class="slideDes">
                            <h2>{{ article.name }}</h2>
                            <p>{{ article.description }}</p>
                            <h4>{{ article.autor}}</h4>
                            <h3>{{ article.price }}</h3> 
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
                {name: 'lfsaf', img: '../images/dogtest.jpg', description: 'jsdhfgjsd', price: '21564'},
                {name: 'lfsaf2', img: '../images/dogtest.jpg', description: 'ghklujl', price: '546546'},
                {name: 'lfsaf3', img: '../images/dogtest.jpg', description: 'jhgdj', price: '45656'},
                {name: 'lfsaf4', img: '../images/dogtest.jpg', description: 'zdgfd', price: '54654'},
                {name: 'lfsaf5', img: '../images/dogtest.jpg', description: 'vczb', price: '5645'},
                {name: 'lfsaf6', img: '../images/dogtest.jpg', description: 'zdfgzd', price: '534'},
                {name: 'lfsaf7', img: '../images/dogtest.jpg', description: 'zdfgzdfg', price: '4568'},
                {name: 'lfsaf8', img: '../images/dogtest.jpg', description: 'hgjfg', price: '8467'},
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
        height: 40vh;
        color: black;
        padding: 15px;
    }

    .slide{
        box-shadow: 0 0 7px;
    }

    .slideDes{
        padding: 15px;
        float: left;
    }

    .slideImg img{
        width: 100%;
    }
</style>