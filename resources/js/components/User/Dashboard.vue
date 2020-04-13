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
    
            <b-modal id="modal-scoped" title="Обновление данных профиля" style="color: black">
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
        
                <template v-slot:modal-footer="{ok}">
                    <b-button size="md" variant="success" @click="updateUser">
                        Обновить
                    </b-button>
                </template>
            </b-modal>
            
            <div class="col-12 col-sm-12 col-md-9 leftBox">
                <div class="col-12">
                    <div class="row userTitle">
                        <span>{{ user.name }}</span>
                    </div>
                    <h2 class="row" style="height: 100px; font-size: 30px; margin-top: 50px"><span style="color: #FF6200;">|</span>Объявления</h2>
                    
                    <div class="articlesBlock row" v-for="(article, index) in articles" :key="index">
                        <span class="col-8 col-sm-6">{{ article.name }}</span>
                        <span class="col-4 col-sm-3">{{ article.date }}</span>
                        <button class="col-sm-1 btn btn-info large_btn" type="submit" @click="articlePage(article.id)"><img src="../../../img/home.svg" alt=""></button>
                        <button class="col-2 offset-6 btn btn-info small_btn" type="submit" @click="articlePage(article.id)"><img src="../../../img/home.svg" alt=""></button>
                        <b-dropdown size="lg" ref="dropdown" variant="warning" class="col-2 col-sm-1" style="padding: 0 !important;" no-caret>
                            <template v-slot:button-content>
                                <b-icon icon="gear-fill" class="bg-warning" style="min-width: 15px; min-height: 15px"></b-icon>
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
                        <button class="col-2 col-sm-1 btn btn-danger" type="submit" @click="remove(article.id, index)"><img src="../../../img/times.svg" alt=""></button>
                    </div>
                </div>
            </div>
    
            <div class="rightBox col-3">
                <div class="row userImage">
                    <img :src="'../'+user.img" alt="Avatar">
                </div>
                <div class="row controlsUser">
                    <b-dropdown variant="warning" text="Изменить данные" class="col-12" style="padding: 0 !important; height: 60px">
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
                img: [],
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
            
            getUser(){
                axios.get('/users', { params: { userId: this.$route.params.userId } })
                    .then(response => { this.user = response.data; });
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

    .articlesBlock{
        border: 1px solid black;
        border-radius: 15px;
        padding: 10px;
        background-color: #2CAF93;
        min-height: 70px;
        margin-bottom: 20px;
        span{
            margin: auto 0;
            float: left;
            -webkit-line-clamp: 0.7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 70%;
            &::first-letter{
                text-transform: uppercase;
            }
        }
    }
    
    .btn{
        border: 1px solid black;
        border-radius: 10px;
        max-height: 50px;
        img{
            width: 100%;
            object-position: top;
            object-fit: cover;
        }
    }
    
    .controlsUser{
        margin-top: 50px;
        padding: 10px;
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
