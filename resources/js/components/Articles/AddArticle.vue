<template xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="row" id="addArticle">
            <form class="formArticle col" enctype="multipart/form-data" method="post" autocomplete="off" @submit.prevent="add">
                
                <div class="form_row article_category">
                    <span>Категория</span>
                    <select-comp class="article_select" v-model="category" :data="categories" placeholder="выберите категорию"></select-comp>
                </div>
                <hr style="background-color: #fff;">
                <center><h1 class="title">Объявление</h1></center>
                <hr style="background-color: #fff;">
                <div class="form_row article_name">
                    <span>Название объявления</span>
                    <input id="name" type="text" class="form-control inputArticle"  placeholder="Название" required v-model="name">
                </div>
                
                <div class="form_row article_des">
                    <span>Описание объявления</span>
                    <b-form-textarea class="textarea" v-model="description" debounce="500" rows="3" max-rows="5"></b-form-textarea>
                </div>

                <div class="form_row article_price">
                    <span>Цена</span>
                    <div class="price">
                        <input type="number" id="price" class="form-control inputArticle" placeholder="Стоимость" v-model="price">
                        <b-form-checkbox class="check" v-model="price" size="lg" value="0">Без цены, отдам в добрые руки</b-form-checkbox>
                    </div>
                </div>
                
                <div class="form_row article_photo">
                    
                    <span>Загрузить фото</span>
                    <uploader
                            class="photo"
                            v-model="fileList"
                            name="upload"
                            title="Фото"
                            limit="1"
                            :headers="{
                              'custom-header': 'custom-info',
                            }"
                            :autoUpload="false"
                            @on-change="onChange"
                            @on-cancel="onCancel"
                            @on-success="onSuccess"
                            @on-error="onError"
                            @on-delete="onDelete"
                    ></uploader>
                </div>
                <div class="form_row button">
                    <button class="btn btn-primary article_btn" type="submit">Опубликовать</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    
    import Uploader from "vux-uploader-component";
    
    export default {
        components: {
            Uploader,
        },
        data() {
            return {
                categories: {},
                name: '',
                description: '',
                img: [],
                category: '',
                price: '',
                fileList: [],
                FormData: new FormData(),
            }
        },
        created(){
            axios.get('/categories')
                .then(response => {
                    this.categories = response.data;
                });
        },
        methods:{
            add(e) {
                this.FormData.append('name', this.name);
                this.FormData.append('description', this.description);
                this.FormData.append('price', this.price);
                this.FormData.append('category', this.category);
    
                let config = {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                };
                
                axios.post('/addArticle', this.FormData, config)
                    .then((response) => {
                        this.$router.push('/');
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            onChange(fileItem, fileList) {
                console.log('on-change: ', fileItem, fileList);
                this.FormData.append('img', fileItem.blob);
            },
            onCancel() {
                console.log('on-cancel: Sucсess')
            },
            onSuccess(res, fileItem) {
                console.log('on-success: ', res)
                fileItem.fileid = res.data
            },
            onError(res) {
                console.log('on-error: ', res)
            },
            onDelete(cb) {
                // setTimeout(() => {
                console.log('on-delete: ', JSON.parse(JSON.stringify(this.fileList)))
                cb && cb()
                // }, 3000);
            }
        }
    }
</script>

<style scoped lang="scss">
    .formArticle{
        position: relative;
        background: #1F7B67;
        padding: 5%;
        font-size: 20px;
    }
    
    .form_row{
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        span{
            flex: 10%;
        }
    }
    
    .title{
        margin-top: 20px;
        margin-bottom: 20px;
    }
    
    .article_category{
        span{
            font-size: 24px;
        }
    }
    
    .article_name{
        span{
            font-size: 16px;
        }
        input{
            flex: 60%;
        }
    }
    
    .article_des{
        span{
            font-size: 16px;
        }
        .textarea{
            flex: 60%;
        }
    }
    
    .article_select{
        flex: 70% !important;
    }
    
    .article_price{
        .price{
            flex: 60%;
            display: flex;
            align-items: center;
            input{
                flex: 30%;
                margin-right: 10px;
            }
            .check{
                flex: 70%;
            }
        }
    }
    
    .button{
        display: flex;
        justify-content: flex-end;
        align-items: center;
        .article_btn{
            height: 50px;
            width: 50%;
        }
    }

    .article_photo{
        .photo{
            flex: 60%;
        }
    }
    

    #addArticle{
        margin-top: 5vh;
        padding: 0 10%;
    }

    .inputArticle {
        height: 50px !important;
    }

    .btn{
        background-color: #FF6200 !important;
        font-size: 20px;
    }
    
    @media(max-width: 540px) {
        .formArticle{
            font-size: 16px;
        }
        .article_category{
            span{
                font-size: 18px;
            }
        }
        .article_des{
            span{
                font-size: 14px;
            }
        }
        .article_price{
            .price{
                flex: 60%;
                display: flex;
                align-items: center;
                input{
                    flex: 40%;
                    margin-right: 5px;
                }
                .check{
                    flex: 60%;
                    font-size: 16px;
                }
            }
        }
        .title{
            font-size: 18px;
        }
    }
    
    @media(max-width: 400px) {
    
        .form_row{
            span{
                flex: 10%;
                margin-right: 5px;
            }
        }
    
        .title{
            font-size: 20px;
        }
    
        .article_category{
            span{
                font-size: 20px;
            }
        }
    
        .article_name{
            span{
                font-size: 18px;
            }
            input{
                flex: 100%;
            }
        }
    
        .article_des{
            span{
                font-size: 18px;
            }
            .textarea{
                flex: 100%;
            }
        }
    
        .article_select{
            flex: 100% !important;
        }
    
        .article_price{
            .price{
                flex: 100%;
                display: flex;
                align-items: center;
                input{
                    flex: 30%;
                    margin-right: 5px;
                }
                .check{
                    flex: 70%;
                }
            }
        }
    
        .article_photo{
            .photo{
                flex: 100%;
            }
        }
    
        .btn{
            font-size: 18px;
        }
    }
</style>
