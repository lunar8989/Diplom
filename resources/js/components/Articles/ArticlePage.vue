<template>
    <div class="container">
        <div class="row">
            
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 leftBox">
                <div class="col-lg-12 articleTitle large">
                    <span>{{ article.name }}</span>
                    <span v-if="article.price != ''">{{ article.price }} Руб.</span>
                    <span v-else>Цена не указана.</span>
                </div>
        
                <div class="col-12 articleImage">
                    <ul>
                        <li><i class="fa fa-bookmark" aria-hidden="true"></i> {{ article.category }}</li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ article.date }}</li>
                    </ul>
                    <img :src="article.img">
                </div>
        
                <div class="photos col-sm-12">
                    <div class="photo col-sm-3">
                        <img :src="article.img" alt="" style="width: 100%; margin-top: 3vh;">
                    </div>
                </div>
    
                <div class="col-12 articleTitle small">
                    <span>{{ article.name }}</span>
                    <span v-if="article.price != ''">{{ article.price }} Руб.</span>
                    <span v-else>Даром.</span>
                </div>
            </div>
    
            <div class="col-lg-3 rightBox large">
                <div class="col-12 articleAuthor">
                    <div class="authorImage"><img v-if="user.img === ''" src="../../../img/user-icon.png">
                    <img v-else :src="user.img" alt=""></div>
                    <label>{{ user.name }}</label>
                </div>
        
                <div class="col-12 articleCont">
                    <p><i class="fa fa-phone" aria-hidden="true"></i> {{ user.phone }}</p>
                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ user.email }}</p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ user.city }}</p>
                </div>
        
                <div class="col-12 articleBtn" v-if="authUser.id !== user.id">
                    <a href="#" class="btn" @click="emailModal">написать</a>
                </div>
    
                <b-modal id="modal-email" title="Форма связи с автором объявления" style="color: black">
                        <b-form>
                            <b-form-group id="input-group-2" label="Ваше сообщение:" label-for="input-2">
                                <b-form-textarea
                                        id="input-2"
                                        v-model="form.message.message"
                                        required
                                        placeholder="Введите сообщение.."
                                ></b-form-textarea>
                            </b-form-group>
                        </b-form>
        
                    <template v-slot:modal-footer="{ok}">
                        <b-button size="sm" @click="mailCreate(user.id)">
                            Отправить
                        </b-button>
                    </template>
                </b-modal>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 leftBox articleDes">
                <nav class="desBtn col-12">
                    <a href="#tab1" class="tabs_item"><i class="fa fa-align-left" aria-hidden="true"></i> описание</a>
                    <a href="#tab2" class="tabs_item"><i class="fa fa-map-marker" aria-hidden="true"></i> карта</a>
                </nav>
        
                <div class="des col-12">
                    <div class="widget" id="tab1">
                        <p>{{ article.description }}</p>
                    </div>
            
                    <div class="widget" id="tab2">
                        <map-comp :city="user.city" style="border: 1px solid black; height: 500px"></map-comp>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-3 rightBox large" style="margin-top: 3%">
    
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
                authUser: {},
                form: {
                    message: {
                        message: '',
                        date: '',
                        author: '',
                    },
                },
            }
        },
        watch: {
            $route(to, from) {
                if(this.id !== this.$route.params.articleId){
                    this.getArticle();
                }
            }
        },
        computed: {
            _user() {
                this.authUser = this.$auth.user();
                this.form.message.author = this.authUser.name;
            }
        },
        methods:{
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
                }
            },
            emailModal(){
                this.$bvModal.show('modal-email');
            },
            mailCreate(userId){
                
                let data = new FormData();
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
                
                let now = new Date();
                
                this.form.message.date = now.getFullYear() + '-' + now.getMonth() + '-' + now.getDate();
                
                data.append('message', this.form.message);
                data.append('lastMessage', this.form.message.message);
                data.append('user', userId);
                
                axios.post('/messageCreate', data, config).then(response =>{
                    this.$bvModal.hide('modal-email');
                    this.$bvModal.msgBoxOk('Сообщение успешно отправлено', {
                        title: 'Успех',
                        size: 'sm',
                        buttonSize: 'sm',
                        okVariant: 'success',
                        headerClass: 'p-2 border-bottom-0',
                        footerClass: 'p-2 border-top-0'
                    }).catch((error) => {
                        this.$bvModal.msgBoxOk('Произошла ошибка,'+ error +', попробуйте снова', {
                            title: 'Ошибка',
                            size: 'sm',
                            buttonSize: 'sm',
                            okVariant: 'danger',
                            headerClass: 'p-2 border-bottom-0',
                            footerClass: 'p-2 border-top-0'
                        })
                    });
                });
            },
        },

        mounted(){
            this.getArticle();
        },
    }
</script>

<style scoped lang="scss">
    
    .authorImage{
        border: 2px solid #FF6200;
        padding: 5%;
        border-radius: 15%;
        img{
            width: 100%;
            object-position: top;
            margin: 0 auto;
            object-fit: cover;
            border-radius: 15%;
        }
    }
    
    .articleAuthor{
        border-bottom: 1px solid gray;
        margin: auto 0;
        margin-bottom: 15px;
        label{
            margin-top: 20px;
            font-size: 25px;
            &::first-letter{
                text-transform: uppercase;
            }
        }
    }

    .articleTitle{
        display: flex;
        border-bottom: 1px solid gray;
        padding: 3vh;
        font-size: 35px !important;
        justify-content: space-between;
        span{
            -webkit-line-clamp: 0.7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            &::first-letter{
                text-transform: uppercase;
            }
        }
    }

    .leftBox{
        background-color: white;
        color: black;
        padding: 3%;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        img{
            width: 100%;
            object-fit: cover;
            object-position: top;
        }
        ul{
            list-style-type: none;
            margin-top: 5px;
            li{
                display: inline;
                margin-right: 3%;
            }
        }
    }
    
    .desBtn a{
        text-decoration: none;
        color: black;
        margin-right: 3%;
    }

    .rightBox{
        background-color: white;
        color: black;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        padding: 15px;
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
        flex: 0 1 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn{
        background-color: #FF6200;
        padding: 1vh;
        width: 100%;
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

    .commentsBtn {
        input[type=text]{
            width: 80%;
            height: 50px;
            float: left;
            &:focus{
                outline: none;
                border-bottom: 2px solid #FF6200;}
        }
        button{
            width: 20%;
            height: 50px;
            background-color: #FF6200;
            color: white;
        }
    }
    
    .widget{
        position: relative;
        display: none;
        padding-top: 10px;
        &:before{
            content: "";
            width: 50%;
            position: absolute;}
        &:target{
            display: block;
        }
        &:nth-child(1):before{
            border-bottom: 2px solid #FF6200;
            left: 0;
        }
        &:nth-child(2):before{
            border-bottom: 2px solid #FF6200;
            right: 0;
        }
        p{
            font-size: 20px;
            margin-top: 10px;
        }
    }
    
    .small{
        display: none;
    }
    
    @media(max-width: 992px) {
        .rightBox{
            display: none;
        }
    }

    @media(max-width: 768px) {
    
        .rightBox{
            display: none;
        }
    
        .userTitle{
            display: none;
        }
    
        .authorImage{
            padding: 10px;
        }
        
        .small{
            display: block;
        }
        
        .articleTitle{
            &.small{
                display: flex;
            }
            span{
                font-size: 18px !important;
            }
        }
        
        .large{
            display: none;
        }
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

    @media(max-width: 576px){
        .photo{
            display: none;
        }
        
        .map{
            height: 500px;
        }
    }

</style>
