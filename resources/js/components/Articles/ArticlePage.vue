<template>
    <div class="container-fluid">
        <div class="row" v-if="article">
            <div class="row">
                <div class="col-sm-11 row">
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
                </div>
    
                <div class="col-sm-1 row">
                    <div class="col-sm-12 articleAuthor">
                        <img :src="user.img">
                        <label>{{ user.name }}</label>
                    </div>
        
                    <div class="col-sm-12 articleCont">
                        <p><i class="fa fa-phone" aria-hidden="true"></i> {{ user.phone }}</p>
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ user.email }}</p>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ user.address }}</p>
                    </div>
        
                    <div class="col-sm-12 articleBtn">
                        <router-link :to="{ name: 'email', params: { id: user.id } }" type="submit">написать</router-link>
                        <router-link :to="{ name: 'profile', params: { id: user.id } }">профиль</router-link>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12 articleDes">
                    <button type="submit"></button>
                    <button type="submit"></button>
                    <button type="submit"></button>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        name: "ArticlePage",
        data(){
            return{
                articles: {},
                article: null,
                users: {},
                user: null,
            }
        },
        created(){
            axios.get('/article')
                .then(response => {
                    this.article = response.data;
                });
            
            var articleId = this.$route.params.id;
            
            this.article = this.articles[articleId];
    
            if(article){
                axios.get('/user')
                    .then(response => {
                        this.users = response.data;
                    });
    
                for(var i = 0; i < users.length; i++){
                    if(users[i].id == articleId){
                        this.user = users[i];
                    }
                }
            }
            
        },
    }
</script>

<style scoped>
    .articleAuthor{
        border-bottom: 1px gray;
    }
    
    .articleTitle{
        border-bottom: 1px gray;
    }
</style>