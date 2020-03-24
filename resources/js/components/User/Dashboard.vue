<template>
    <div class="container">
        <div class="row" v-if="this.user">
            <div class="col-9 leftBox row">
                <div class="col-12">
                    <div class="row userTitle">
                        <h1>{{ user.name }}</h1>
                    </div>
                    <h2 class="row" style="height: 100px; margin-top: 50px"><span style="color: #FF6200;">|</span>Объявления</h2>
    
    
                    <div class="articlesBlock row" v-for="(article, index) in articles" :key="index">
                        <h5 class="col-6">{{ article.name }}</h5>
                        <h5 class="col-3">{{ article.date }}</h5>
                        <button class="col-1 btn btn-info" type="submit" @click="articlePage(article.id)"><i class="fa fa-home fa-2x" aria-hidden="true"></i></button>
                        <b-dropdown size="lg" ref="dropdown" variant="warning" class="col-1" style="padding: 0 !important;" no-caret>
                            <template v-slot:button-content>
                                <b-icon icon="gear-fill" class="bg-warning" style="width: 30px; height: 30px; color: black"></b-icon>
                            </template>
                            <b-dropdown-form>
                                <b-form-group label="Название" label-for="dropdown-form-name" @submit.stop.prevent>
                                    <b-form-input
                                            id="dropdown-form-name"
                                            size="lg"
                                            v-model="article.name"
                                            :value="article.name"
                                    ></b-form-input>
                                </b-form-group>
            
                                <b-form-group label="Описание" label-for="dropdown-form-description">
                                    <b-form-textarea
                                            id="dropdown-form-description"
                                            size="lg"
                                            :value="article.description"
                                            v-model="article.description"
                                    ></b-form-textarea>
                                </b-form-group>
    
                                <b-form-group label="Стоимость" label-for="dropdown-form-price">
                                    <b-form-input
                                            id="dropdown-form-price"
                                            type="number"
                                            size="lg"
                                            :value="article.price"
                                            v-model="article.price"
                                    ></b-form-input>
                                </b-form-group>
                                
                                <b-button variant="primary" size="sm" @click="onClick(article.id, article.name, article.description, article.price)">Обновить</b-button>
                            </b-dropdown-form>
                        </b-dropdown>
                        <button class="col-1 btn btn-danger" type="submit" @click="remove(article.id, index)"><i class="fa fa-times fa-2x" aria-hidden="true"></i></button>
                        
                    </div>
                </div>
            </div>
    
            <div class="rightBox col-3">
                <div class="row userImage">
                    <img v-if="user.img = ''" :src="user.img">
                    <img v-else src="../../../img/user-icon.png">
                </div>
                <div class="row controlsUser">
                    <b-dropdown variant="warning" text="Изменить данные" class="col-12" style="padding: 0 !important;" >
                        <b-dropdown-form>
                            <b-form-group label="Название" label-for="dropdown-form-username" @submit.stop.prevent>
                                <b-form-input
                                        id="dropdown-form-username"
                                        size="lg"
                                        v-model="user.name"
                                        :value="user.name"
                                ></b-form-input>
                            </b-form-group>
            
                            <b-form-group label="Телефон" label-for="dropdown-form-phone">
                                <b-form-input
                                        id="dropdown-form-phone"
                                        size="lg"
                                        type="tel"
                                        :value="user.phone"
                                        v-model="user.phone"
                                ></b-form-input>
                            </b-form-group>
            
                            <b-form-group label="Фото профиля" label-for="dropdown-form-photo">
                                <b-form-file
                                        id="dropdown-form-photo"
                                        size="lg"
                                        :file-name-formatter="formatNames"
                                        @change="getImg($event)"
                                ></b-form-file>
                            </b-form-group>
            
                            <b-button variant="primary" size="sm" @click="updateUser(user.id, user.name, user.phone)">Обновить</b-button>
                        </b-dropdown-form>
                    </b-dropdown>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    
    export default {
        name: "Dashboard",
        data(){
            return{
                user: {},
                articles: {},
                success: false,
                FormData: new FormData(),
            }
        },
        created() {
            this.getUser();
            
            if (this.user){
                this.getArticles(this.$route.params.userId);
            }
            
        },
        methods:{
            onClick(id, name, des, price) {
                axios.get('/articleUpdate', { params: { articleId: id, name: name, description: des, price: price } })
                    .then(response=>{
                       this.success = response.data;
                    });
                this.$refs.dropdown.hide(true);
            },
            
            remove(id, index){
                axios.get('/removeArticle', { params: { articleId: id }});
                Vue.delete(this.articles, index);
            },
            
            getArticles(id){
                axios.get('/getArticles', { params: { userId: id } })
                    .then(response => { this.articles = response.data; });
            },
    
            articlePage(id){
                this.$router.push({ name: 'Article', params: { articleId: id }})
            },
    
            formatNames(files) {
                if (files.length === 1) {
                    return files[0].name
                } else {
                    return `${files.length} files selected`
                }
            },
            
            getUser(){
                axios.get('/users', { params: { userId: this.$route.params.userId } })
                    .then(response => { this.user = response.data; });
            },
    
            getImg(e){
                let input = e.target;
                if (input.files[0]) {
                    if (input.files.length <= 5) {
                
                        for (let i = 0; i < input.files.length; i++) {
                            let reader = new FileReader();
                    
                            reader.onload = e => {
                                this.img.push(e.target.result);
                            };
                    
                            reader.readAsDataURL(input.files[i]);
                    
                            Array.from(Array(e.target.files.length).keys())
                                .map(x => {
                            
                                    this.FormData
                                        .append('img',
                                            e.target.files[x]);
                            
                                });
                        }
                    } else {
                        alert('You can upload up to 5 images');
                    }
                }
            },
    
            updateUser(id, name, phone){
                this.FormData.append('userId', id);
                this.FormData.append('name', name);
                this.FormData.append('phone', phone);
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
    
                axios.post('/updateUser', this.FormData, config)
                    .then((response) => {
                        this.getUser();
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        
        
        
    }
</script>

<style scoped>
    
    .userImage{
        border: 2px solid #FF6200;
        padding: 3vh;
        max-height: 40vh;
        border-radius: 15%;
    }
    
    .userImage img{
        width: 70%;
        margin-left: 15%;
        margin-right: 15%;
        border-radius: 50%;
    }
    
    .userTitle{
        height: 70px;
        border-bottom: 1px solid gray;
        padding: 3vh;
        font-size: 35px !important;
    }
    
    .userTitle h2{
        float: left;
        display: -webkit-box;
        -webkit-line-clamp: 0.7;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.5em;
        text-overflow: ellipsis;
        width: 70%;
    }
    
    .leftBox{
        background-color: white;
        color: black;
        padding: 3%;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        min-height: 70vh;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
    }
    
    .rightBox{
        background-color: #1F7B67;
        color: black;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        min-height: 100vh;
        padding: 3%;
        border-bottom-right-radius: 15px;
        border-top-right-radius: 15px;
    }

    .articlesBlock{
        border: 1px solid black;
        border-radius: 15px;
        padding: 10px;
        background-color: #2CAF93;
        min-height: 70px;
        margin-bottom: 20px;
    }
    
    .articlesBlock h5{
        margin: auto 0;
        float: left;
        display: -webkit-box;
        -webkit-line-clamp: 0.7;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 70%;
    }
    
    .btn{
        border: 1px solid black;
        border-radius: 10px;
    }
    
    .controlsUser{
        margin-top: 50px;
        padding: 10px;
    }
    
    .dropdown-toggle{
        height: 45px !important;
    }
</style>
