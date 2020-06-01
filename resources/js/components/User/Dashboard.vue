<template>
    <div class="container">
        <div class="row" style="margin: 0 !important;" v-if="this.user">
            <div class="col-12 col-sm-12 topBox">
                <div class="userImage">
                    <img :src="'../'+user.img" alt="Avatar">
                </div>
                <div class="topTitle">
                    <span>{{ user.name }}</span>
                    
                    <div class="small">
                        <i class="fa fa-cog fa-2x" @click="updateUserModal"></i>
                    </div>
                </div>
                <div class="top_controls_user large">
                    <b-dropdown variant="warning" right text="Изменить данные" style="padding: 0 !important; height: 50px;" >
                        <b-dropdown-form>
                            <b-form-group label="Название" label-for="dropdown-form-username">
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
                                        accept=".jpg, .png, .jpeg"
                                        :file-name-formatter="formatNames"
                                        @change="getImg($event)"
                                ></b-form-file>
                            </b-form-group>
                
                            <b-button variant="primary" size="sm" @click="updateUser">Обновить</b-button>
                        </b-dropdown-form>
                    </b-dropdown>
                </div>
            </div>
    
            <b-modal id="modal-scoped" title="Обновление данных" style="color: black;">
                <b-form>
                    <b-form-group label="Название" label-for="dropdown-form-username">
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
                                accept=".jpg, .png, .jpeg"
                                :file-name-formatter="formatNames"
                                @change="getImg($event)"
                        ></b-form-file>
                    </b-form-group>
                </b-form>
        
                <template v-slot:modal-footer="{ok}" class="modal_btn">
                    <b-button size="md" variant="success" @click="updateUser">
                        Обновить
                    </b-button>
                </template>
            </b-modal>
    
            <b-modal id="modal-article" title="Обновление данных" style="color: black;">
                <b-form>
                    <b-form-group label="Название" label-for="dropdown-form-name">
                        <b-form-input
                                id="dropdown-form-username"
                                size="lg"
                                v-model="updatedArticle.name"
                                :value="updatedArticle.name"
                        ></b-form-input>
                    </b-form-group>
            
                    <b-form-group label="Описание" label-for="dropdown-form-des">
                        <b-form-textarea
                                id="dropdown-form-des"
                                size="lg"
                                type="textarea"
                                :value="updatedArticle.description"
                                v-model="updatedArticle.description"
                        ></b-form-textarea>
                    </b-form-group>
    
                    <b-form-group label="Цена" label-for="dropdown-form-price">
                        <b-form-input
                                id="dropdown-form-price"
                                size="lg"
                                type="number"
                                :value="updatedArticle.price"
                                v-model="updatedArticle.price"
                        ></b-form-input>
                    </b-form-group>
            
                    <b-form-group label="Фото объявления" label-for="dropdown-form-photo">
                        <b-form-file
                                id="dropdown-form-photo"
                                accept=".jpg, .png, .jpeg"
                                :file-name-formatter="formatNames"
                                @change="getImg($event)"
                        ></b-form-file>
                    </b-form-group>
                </b-form>
        
                <template v-slot:modal-footer="{ok}" class="modal_btn">
                    <b-button size="md" variant="success" @click="updateArticle(updatedArticle.id)">
                        Обновить
                    </b-button>
                </template>
            </b-modal>
            
            <div class="col-12 col-sm-12 col-md-9 leftBox">
                <div class="col-12">
                    <div class="row userTitle">
                        <span>{{ user.name }}</span>
                    </div>
                    <div class="content_title row">
                        <h2 style="height: 100px; font-size: 30px; margin-top: 50px"><span style="color: #FF6200;">|</span>
                            <span v-if="content === 'articles'">Объявления</span>
                            <span v-else>Сообщения</span>
                        </h2>
                        
                        <button v-if="content === 'articles'" @click="content = 'message'">Сообщения</button>
                        <button v-else @click="content = 'articles'">Объявления</button>
                    </div>
                    
                    <div class="articlesBlock" v-for="(article, index) in articles" :key="index" v-if="content === 'articles'">
                        <div class="article_img">
                            <img :src="'../'+article.img">
                        </div>
                        <div class="article_info">
                            <span class="article_name">{{ article.name }}</span>
                            <span class="article_price" v-if="article.price != ''">{{ article.price }} р.</span>
                            <span class="article_price" v-else>Даром.</span>
                        </div>
                        <div class="article_buttons">
                            <span class="article_btn"><img src="../../../img/eye.svg">{{ article.views }}</span>
                            <span class="article_btn"><img src="../../../img/heart.svg">{{ article.likes }}</span>
                            <b-dropdown right no-flip class="article_btn" variant="link" style="padding: 0 !important;" toggle-class="text-decoration-none" no-caret>
                                <template v-slot:button-content>
                                    <img src="../../../img/ellipsis.svg">
                                </template>
                                <b-dropdown-item href="#" class="article_action" @click="articlePage(article.id)">Перейти</b-dropdown-item>
                                <b-dropdown-item href="#" class="article_action" @click="updateArticleModal(article.id, article.name, article.description, article.img, article.price)">Изменить</b-dropdown-item>
                                <b-dropdown-item href="#" class="article_action" @click="remove(article.id, index)">Удалить</b-dropdown-item>
                            </b-dropdown>
                        </div>
                    </div>
                    
                    <div class="messages_box" v-for="(message, index) in messages" :key="index" v-if="content === 'message'">
                        <div class="message_author">
                            <span>{{ message.authorName }}</span>
                        </div>
                        <div class="message_content">
                            <div class="message_value">
                                <span class="value" :class="{ 'new': message.status === 1, 'check': message.status === 0 }">{{ message.lastMessage }}</span>
                            </div>
                            
                            <button class="message_button" :class="{ 'new': message.status === 1, 'check': message.status === 0 }" @click="chat(message)">Перейти</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="rightBox col-3">
                <div class="row userImage">
                    <img :src="'../'+user.img" alt="Avatar">
                </div>
                <div class="row controlsUser">
                    <button @click="updateUserModal" class="col-12 update_user_btn">Изменить данные</button>
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
                updatedArticle: {
                    id: '',
                    name: '',
                    description: '',
                    img: '',
                    price: 0,
                },
                messages: {},
                success: false,
                img: [],
                FormData: new FormData(),
                content: 'articles',
            }
        },
        created() {
            this.getUser(this.$route.params.userId);
            
            if (this.user){
                this.getArticles(this.$route.params.userId);
                this.getMessages(this.$route.params.userId)
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
    
            chat(message){
                let data = new FormData();
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
                
                data.append('status', '0');
                data.append('id', message.id);
                
                axios.post('/messageUpdate', data, config);
                this.$router.push({ name: 'Chat', params: {
                        userId: this.$route.params.userId,
                        messageId: message.id,
                }});
            },
            
            getArticles(id){
                axios.get('/getArticles', { params: { userId: id } })
                    .then(response => { this.articles = response.data; });
            },
            
            getMessages(id){
                axios.get('/getMessages', { params: { userId: id } })
                    .then(response => { this.messages = response.data;});
            },
    
            articlePage(id){
                this.$router.push({ name: 'Article', params: { articleId: id }})
            },
            
            getUser(id){
                axios.get('/users', { params: { userId: id } })
                    .then(response => { this.user = response.data; });
            },
    
            updateArticle(id){
                this.FormData.append('id', id);
                this.FormData.append('name', this.updatedArticle.name);
                this.FormData.append('description', this.updatedArticle.description);
                this.FormData.append('price', this.updatedArticle.price);
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
    
                axios.post('/articleUpdate', this.FormData, config)
                    .then((response) => {
                        this.$bvModal.msgBoxOk('Данные обновлены успешно.', {
                            title: 'Успех',
                            size: 'sm',
                            buttonSize: 'sm',
                            okVariant: 'success',
                            headerClass: 'p-2 border-bottom-0',
                            footerClass: 'p-2 border-top-0'
                        })
                    })
                    .catch((error) => {
                        this.$bvModal.msgBoxOk('Данные не удалось обновить, попробуйте снова', {
                            title: 'Ошибка',
                            size: 'sm',
                            buttonSize: 'sm',
                            okVariant: 'danger',
                            headerClass: 'p-2 border-bottom-0',
                            footerClass: 'p-2 border-top-0'
                        })
                    });
            },
    
            updateUser(e){
                this.FormData.append('userId', this.user.id);
                this.FormData.append('name', this.user.name);
                this.FormData.append('phone', this.user.phone);
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
    
                axios.post('/updateUser', this.FormData, config)
                    .then((response) => {
                        this.$bvModal.msgBoxOk('Данные обновлены успешно.', {
                            title: 'Успех',
                            size: 'sm',
                            buttonSize: 'sm',
                            okVariant: 'success',
                            headerClass: 'p-2 border-bottom-0',
                            footerClass: 'p-2 border-top-0'
                        })
                    })
                    .catch((error) => {
                        this.$bvModal.msgBoxOk('Данные не удалось обновить, попробуйте снова', {
                            title: 'Ошибка',
                            size: 'sm',
                            buttonSize: 'sm',
                            okVariant: 'danger',
                            headerClass: 'p-2 border-bottom-0',
                            footerClass: 'p-2 border-top-0'
                        })
                    });
            },
            
            formatNames(files) {
                if (files.length === 1) {
                    return files[0].name
                } else {
                    return `${files.length} files selected`
                }
            },
            
            getImg(e){
                let input = e.target;
                if (input.files[0]) {
                    for (let i = 0; i < input.files.length; i++) {
                        let reader = new FileReader();
        
                        reader.onload = e => {
                            this.img.push(e.target.result);
                        };
        
                        reader.readAsDataURL(input.files[i]);
        
                        Array.from(Array(e.target.files.length).keys())
                            .map(x => {
                
                                this.FormData.append('img', e.target.files[x]);
                
                            });
                    }
                }
            },
            
            updateUserModal(){
                this.$bvModal.show('modal-scoped');
            },
            updateArticleModal(id, name, des, img, price){
                this.updatedArticle.id = id;
                this.updatedArticle.name = name;
                this.updatedArticle.description = des;
                this.updatedArticle.img = img;
                this.updatedArticle.price = price;
                this.$bvModal.show('modal-article');
            },
        },
    }
</script>

<style scoped lang="scss">
    
    .userImage{
        border: 2px solid #FF6200;
        border-radius: 15%;
        padding: 5%;
        img{
            width: 100%;
            margin: 0 auto;
            object-position: top;
            object-fit: cover;
            border-radius: 15%;}
    }
    
    .userTitle{
        height: 70px;
        border-bottom: 1px solid gray;
        padding: 3vh;
        font-size: 35px !important;
        span{
            float: left;
            -webkit-line-clamp: 0.7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.5em;
            text-overflow: ellipsis;
            width: 70%;
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
    
    .content_title{
        display: flex;
        justify-content: space-between;
        align-items: center;
        button{
            background-color: #FF6200;
            border-radius: 10px;
            color: #fff;
            font-size: 18px;
            height: 40px;
            padding: 5px;
            &:hover{
                background-color: gray;
            }
            &:focus{
                outline-style: none;
            }
        }
    }

    .articlesBlock{
        display: flex;
        border: 1px solid black;
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        padding: 14px;
        margin-bottom: 10px;
    }

    .article_img{
        flex: 30%;
        img{
            width: 100%;
        }
    }
    
    .article_info{
        flex: 50%;
        margin-left: 20px;
        font-size: 20px;
        .article_name{
            width: 100%;
            margin: auto 0;
            float: left;
            -webkit-line-clamp: 0.7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            &::first-letter{
                text-transform: uppercase;
            }
        }
        .article_price{
            width: 100%;
        }
    }
    
    .article_buttons{
        flex: 20%;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        .article_btn{
            flex: 33.3333%;
            display: flex;
            align-items: center;
            height: 30px !important;
            padding: 0 !important;
            img{
                width: 30px;
                height: 30px;
                border: 0.5px solid #A6A6A6;
                border-radius: 4px;
                padding: 3px;
                margin-right: 3px;
            }
        }
    }
    
    .article_action:hover{
        background-color: #FF6200;
    }

    .messages_box{
        padding: 10px;
        height: 80px;
        background: #FFFFFF;
        border: 0.5px solid #A6A6A6;
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        margin-bottom: 10px;
        .message_author{
            width: 100%;
            height: 20px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            color: #FF6200;
            font-size: 22px;
            &::first-letter{
                text-transform: uppercase !important;
            }
        }
        .message_content{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            .message_value{
                .value{
                    font-size: 20px;
                    -webkit-line-clamp: 0.7;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    height: 1em;
                    text-overflow: ellipsis;
                    background-color: #fff;
                    &::first-letter{
                        text-transform: uppercase !important;
                    }
                    &::before{
                        content: '';
                        width: 10px;
                        height: 10px;
                        border-radius: 50%;
                        background-color: gray;
                        display: inline-block;
                        margin-right: 5px;
                    }
                    &.new{
                        &::before{
                            content: '';
                            width: 10px;
                            height: 10px;
                            border-radius: 50%;
                            display: inline-block;
                            margin-right: 5px;
                            background-color: #FF6200 !important;
                        }
                    }
                }
            }
            .message_button{
                padding: 10px;
                height: 40px;
                border-radius: 10px;
                color: #fff;
                &:hover{
                    background-color: gray;
                }
            }
        }
    }

    .new{
        background-color: #FF6200;
    }
    
    .check{
        background-color: gray;
    }
    
    .btn{
        border: 1px solid black;
        border-radius: 10px;
        max-height: 50px;
        padding: 5px !important;
        img{
            width: 100%;
            object-position: top;
            object-fit: cover;
        }
    }
    
    .controlsUser{
        margin-top: 50px;
        padding: 10px;
        button{
            height: 60px;
            padding: 5px;
            background-color: #FF6200;
            color: white;
            border-radius: 15px;
            outline-style: none;
            font-size: 18px;
            &:hover{
                background-color: gray;
            }
        }
    }
    
    .modal_btn{
        padding: 10px;
        font-size: 18px;
    }
    
    .dropdown-toggle{
        height: 45px !important;
    }
    
    .topBox{
        display: none;
        background-color: #1F7B67;
        color: black;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        padding: 3%;
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;
        img{
            flex: 0 0 30%;
        }
    }
    
    .topTitle{
        flex: 0 0 50%;
        padding: 0 0 0 15px;
        span{
            font-size: 20px;
            -webkit-line-clamp: 0.7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 1em;
            text-overflow: ellipsis;
            &::first-letter{
                text-transform: uppercase !important;
            }
        }
    }
    
    .top_controls_user{
        flex: 0 0 20%;
    }
    
    .small, .small_btn{
        display: none;
    }
    
    @media(max-width: 1080px){
        .btn{
            padding: 0 !important;
            img{
                width: 70%;
            }
        }
    }

    @media(max-width: 768px) {
        .topBox{
            display: flex;
            align-items: center;
        }
        
        .rightBox{
            display: none;
        }
        
        .leftBox{
            border-radius: 0 0 15px 15px;
        }
    
        .userTitle{
            display: none;
        }
        
        .userImage{
            padding: 10px;
        }
    }

    @media(max-width: 576px) {
        .btn{
            padding: 5px !important;
            max-height: 60px;
            img{
                width: 50%;
            }
        }
    
        .dropdown-toggle{
            max-height: 60px !important;
        }
    
        .small_btn{
            display: block;
        }
    
        .large_btn{
            display: none;
        }
    }

    @media(max-width: 450px) {
        .top_controls_user{
            width: 100%;
            text-align: center;
        }
    
        .topTitle{
            width: 100%;
            text-align: center;
            margin: 0 0 20px 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
        }
    
        .topBox{
            display: block;
            img{
                width: 100%;
            }
        }
    
        .userImage{
            width: 50%;
            margin: 0 auto;
            margin-bottom: 20px;
        }
    
        .small{
            display: block;
        }
    
        .large{
            display: none;
        }
    
        .btn{
            img{
                width: 70%;
            }
        }
    }
</style>
