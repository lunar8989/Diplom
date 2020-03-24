<template>
    <div class="container">
        <div class="row" id="addArticle">
            <form class="formArticle col" enctype="multipart/form-data" method="post" autocomplete="off" @submit.prevent="add">
                <label class="col-12 labelArticleForm">Добавить новое объявление</label>
                <hr class="hrArticleForm">

                <div class="form-row">
                    <div class="col-12">
                        <label>Название</label>
                        <input id="name" type="text" class="form-control inputArticle"  placeholder="Название" required v-model="name">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-12" style="padding: 5px">
                        <label>Описание</label>
                        <b-form-textarea v-model="description" debounce="500" rows="3" max-rows="5"></b-form-textarea>
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="col-12">
                        <label>Категория</label>
                        <select-comp v-model="category" :data="categories"></select-comp>
                    </div>
                </div>

                <hr class="hrArticleForm">

                <div class="form-row">
                    <div class="col-12">
                        <label>Стоимость</label>
                        <input type="number" id="price" class="form-control inputArticle" placeholder="Стоимость" v-model="price">
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="col-12" >
                        <label>Город</label>
                        <select-comp v-model="city" :data="cities"></select-comp>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-12">
                        <label>Адрес</label>
                        <input type="text" id="address" class="form-control inputArticle" placeholder="Адрес" v-model="address">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-12">
                        <label>Изображение</label>
                        <b-form-file multiple :file-name-formatter="formatNames" @change="getImg($event)"></b-form-file>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Добавить объявление</button>
            </form>
        </div>
    </div>
</template>

<script>
    
    var cities = require('../../cities');
    
    export default {
        data() {
            return {
                cities: cities,
                categories: {},
                name: '',
                description: '',
                img: [],
                category: '',
                price: '',
                address: '',
                city: '',
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
                this.FormData.append('category', this.category.name);
                this.FormData.append('address', this.address);
                this.FormData.append('city', this.city.name);
    
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
        }
    }
</script>

<style scoped>
    .formArticle{
        position: relative;
        background: #1F7B67;
        padding: 5%;
        font-size: 20px;
    }

    .labelArticleForm{
        font-size: 35px;
        text-align: center;
    }

    #addArticle{
        margin-top: 5vh;
        padding: 0 10%;
    }

    .inputArticle {
        height: 50px !important;
    }

    .hrArticleForm{
        background:white;
    }

    .btn{
        background-color: #FF6200 !important;
        font-size: 20px;
    }
</style>
