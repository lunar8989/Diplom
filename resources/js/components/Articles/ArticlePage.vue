<template>
    <div class="container">
        <div class="row">
            <div class="col-9 row leftBox">
                <div class="col-12 articleTitle">
                    <h2>{{ article.name }}</h2>
                    <h3 v-if="article.price != ''">{{ article.price }} Руб.</h3>
                    <h3 v-else>Цена не указана.</h3>
                </div>
        
                <div class="col-12 articleImage">
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
    
            <div class="col-3 rightBox row">
                <div class="col-12 articleAuthor">
                    <img src="../../../img/user-icon.png">
                    <label>{{ user.name }}</label>
                </div>
        
                <div class="col-12 articleCont">
                    <p><i class="fa fa-phone" aria-hidden="true"></i> {{ user.phone }}</p>
                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ user.email }}</p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ article.city }}</p>
                </div>
        
                <div class="col-12 articleBtn">
                    <router-link :to="{ name: 'email', params: { id: user.id } }" class="btn">написать</router-link>
                    <router-link :to="{ name: 'profile', params: { id: user.id } }" class="btn">профиль</router-link>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-9 articleDes leftBox row">
                <nav class="desBtn col-12">
                    <a href="#tab1" class="tabs_item"><i class="fa fa-align-left" aria-hidden="true"></i> описание</a>
<!--                    <a href="#tab2" class="tabs_item"><i class="fa fa-commenting" aria-hidden="true"></i> комментарии</a>-->
                    <a href="#tab3" class="tabs_item"><i class="fa fa-map-marker" aria-hidden="true"></i> карта</a>
                </nav>
        
                <div class="des col-12" >
                    <div class="widget" id="tab1">
                        {{ article.description }}
                    </div>
            
<!--                    <div class="widget" id="tab2">-->
<!--                        <div class="comments">-->
<!--                            <div class="comment" v-for="(comment, index) in comments" :key="index">-->
<!--                                {{ comment.value }}-->
<!--                                {{ comment.date }}-->
<!--                                {{ comment.user }}-->
<!--                            </div>-->
<!--                        </div>-->
<!--                -->
<!--                       <div class="commentsBtn">-->
<!--                          <input type="text" v-model="newComment">-->
<!--                           <button class="comBtn" type="submit" @click="addComment">Отправить</button>-->
<!--                        </div>-->
<!--                    </div>-->
            
                    <div class="widget" id="tab3">
                        <map-comp :city="article.city"></map-comp>
                    </div>
                </div>
            </div>
    
            <div class="col-3 rightBox row" style="margin-top: 3%">
    
            </div>
        </div>
    </div>
    
</template>

<script>
    
    export default {
        data(){
            return{
                article: {},
                user: {},
                id: null,
                comments: {},
                newComment: '',
            }
        },
        watch: {
            $route(to, from) {
                if(this.id !== this.$route.params.articleId){
    
                    this.getArticle();
                }
            }
        },
        methods:{
            addComment(){
                var data = new FormData;
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
    
                data.append('value', this.newComment);
                data.append('article_id', this.article.id);
    
                axios.post('/addComment', data, config);
            },
            getArticle(){
                this.id = this.$route.params.articleId;
    
                axios.get('/articles', { params: {
                        articleId:  this.id
                    }}).then(response => {
                    this.article = response.data;
                });
    
                if(this.article){
                    axios.get('/userArticle',{ params: {
                            articleId:  this.id
                        }}).then(response => {
                        this.user = response.data;
                    });
        
                    axios.get('/comments',{ params: {
                            articleId: this.id
                        }}).then(response => {
                        this.comments = response.data;
                    });
                }
            }
        },

        mounted(){
            this.getArticle();
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

    /*.desBtn li{*/
    /*    border-bottom: 2px solid #FF6200;*/
    /*}*/
    
    
    .desBtn a{
        text-decoration: none;
        color: black;
        margin-right: 3%;
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
        min-height: 50vh;
        margin: 0 auto;
    }

    .desBtn{
        font-size: 25px;
        display: flex;
    }
    
    .tabs_item{
        flex: 0 1 33.333%;
        display: flex;
        justify-content: center;
        align-items: center;
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
    
    .widget{
        position: relative;
        display: none;
        padding: 10px;
    }
    
    .widget:before{
        content: "";
        width: 33.333%;
        position: absolute;
    }
    
    .widget:target{
        display: block;
    }
    
    .widget:nth-child(1):before{
        border-bottom: 2px solid #FF6200;
        left: 0;
    }
    
    .widget:nth-child(2):before{
        border-bottom: 2px solid #FF6200;
        left: 33.333%;
    }
    
    .widget:nth-child(3):before{
        border-bottom: 2px solid #FF6200;
        right: 0;
    }
    
    @media(max-width: 600px){
        .tabs_item{
            display: block;
            width: 100px;
            padding: 0 5px;
            white-space: nowrap;
            text-align: center;
            overflow: hidden;
            font-size: 14px;
            text-overflow: ellipsis;
        }
    }

</style>
