<template>
    <div class="container">
            <div class="row" v-if="article">
                <div class="col-sm-9 row leftBox">
                    <div class="col-sm-12 articleTitle">
                        <h2>{{ article.name }}</h2>
                        <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3>
                        <h3 v-else>Цена не указана.</h3>
                    </div>

                    <div class="col-sm-12 articleImage">
                        <ul>
                            <li><i class="fa fa-bookmark" aria-hidden="true"></i> {{ article.category }}</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ article.date }}</li>
                        </ul>
                        <img :src="article.img">
                    </div>

                    <div class="photos col-sm-12 row">
                        <div class="photo col-sm-3">
                            <img :src="article.img" alt="" style="width: 100%; margin-top: 3vh;">
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 rightBox row">
                    <div class="col-sm-12 articleAuthor">
                        <img src="../../../img/user-icon.png">
                        <label>{{ user.name }}</label>
                    </div>

                    <div class="col-sm-12 articleCont">
                        <p><i class="fa fa-phone" aria-hidden="true"></i> {{ user.phone }}</p>
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ user.email }}</p>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ user.address }}</p>
                    </div>

                    <div class="col-sm-12 articleBtn">
                        <router-link :to="{ name: 'email', params: { id: user.id } }" class="btn">написать</router-link>
                        <router-link :to="{ name: 'profile', params: { id: user.id } }" class="btn">профиль</router-link>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 articleDes leftBox row">
                    <ul class="desBtn col-sm-12">
                        <li @click="des"><i class="fa fa-align-left" aria-hidden="true"></i> описание</li>
                        <li @click="com"><i class="fa fa-commenting" aria-hidden="true"></i> комментарии</li>
                        <li @click="map"><i class="fa fa-map-marker" aria-hidden="true"></i> карта</li>
                    </ul>

                    <div class="des col-sm-12">
                        <div class="vidjet" v-if="desStatus">
                            {{ article.description }}
                        </div>

                        <div class="vidjet" v-if="comStatus">
                            <div class="comments">
                                <div class="comment" v-for="comment in comments" :key="comment.id">
                                
                                </div>
                            </div>

                            <div class="commentsBtn">
                                <input type="text" v-model="message">
                                <button class="comBtn">Отправить</button>
                            </div>
                        </div>

                        <div class="vidjet" v-if="mapStatus">
                            <map-comp></map-comp>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 rightBox row" style="margin-top: 3%">

                </div>
            </div>

    </div>
</template>

<script>
    export default {
        name: "ArticlePage",
        data(){
            return{
                article: {},
                user: null,
                id: null,
                comments: {},
                desStatus: true,
                comStatus: false,
                mapStatus: false,
            }
        },

        methods:{
            des() {
                this.desStatus = true;
                this.comStatus = false;
                this.mapStatus = false;
            },

            com() {
                this.desStatus = false;
                this.comStatus = true;
                this.mapStatus = false;
            },

            map() {
                this.desStatus = false;
                this.comStatus = false;
                this.mapStatus = true;
            }
        },

        created(){
            this.id = this.$route.params.articleId;

            axios.get('/articles', { params: {
                    id:  this.id
                }}).then(response => {
                this.article = response.data;
            });

            if(this.article){
                axios.get('/users',{ params: {
                    id:  1
                }}).then(response => {
                    this.user = response.data;
                });

                axios.get('/comments',{ params: {
                        id:  1
                }}).then(response => {
                    this.comments = response.data;
                });
            }
        },

    }
</script>

<style scoped>
    .articleAuthor{
        border-bottom: 1px solid gray;
        padding: 3vh;
    }

    .articleAuthor img{
        width: 70%;
        margin-left: 15%;
        margin-right: 15%;
        border-radius: 50%;
    }
    
    .articleAuthor label{
        margin-top: 3vh;
        font-size: 25px;
    }

    .articleTitle{
        border-bottom: 1px solid gray;
        padding: 3vh;
        font-size: 35px !important;
    }

    .articleTitle h2{
        float: left;
        display: -webkit-box;
        -webkit-line-clamp: 0.7;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.5em;
        text-overflow: ellipsis;
        width: 70%;
    }

    .articleTitle h3{
        float: right;
    }

    .leftBox{
        background-color: white;
        color: black;
        padding: 3%;
        margin-right: 3%;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }

    .leftBox img{
        width: 100%;
    }

    .leftBox ul{
        list-style-type: none;
    }
    
    .leftBox ul li{
        display: inline;
        margin-right: 3%;
    }

    .desBtn li{
        border-bottom: 2px solid #FF6200;
    }

    .desBtn li:hover{
        cursor: pointer;
    }

    .rightBox{
        background-color: white;
        color: black;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }

    .articleDes{
        margin-top: 3%;
    }

    .des{
        height: 100vh;
    }

    .desBtn{
        font-size: 25px;
    }

    .btn{
        background-color: #FF6200;
        padding: 1vh;
        width: 100%;
        margin: 3%;
        text-decoration: none;
        color: white;
        font-size: 25px;
    }

    .comments{
        width: 100%;
        height: 50vh;
        box-shadow: inset 2px 2px 5px rgba(154, 147, 140, 0.5), 1px 1px 5px rgba(255, 255, 255, 1);
        margin-bottom: 2vh;
    }

    .commentsBtn input[type=text]{
        width: 80%;
        height: 50px;
        float: left;
    }

    .commentsBtn input[type=text]:focus{
        outline: none;
        border-bottom: 2px solid #FF6200;
    }

    .commentsBtn button{
        width: 20%;
        height: 50px;
        background-color: #FF6200;
        color: white;
    }

</style>
