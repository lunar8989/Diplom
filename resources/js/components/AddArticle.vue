<template>
    <div class="container">
        <div class="row" id="addArticle">
            <form class="formarticle col" enctype="multipart/form-data" method="post" novalidate ="" autocomplete="off" @submit.prevent="login">
                <label class="col-sm-12 labelArticleForm">Добавить новое объявление</label>
                <hr class="hrArticleForm">

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label>Название</label>
                        <input type="text" class="form-control inputarticle" placeholder="Название" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Описание</label>
                        <input type="text" class="form-control inputarticle" placeholder="Описание" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Изображение</label>
                        <div class="custom-file filearticle">
                            <input type="file" class="custom-file-input inputarticle" name="photo" accept="image/jpeg,image/png" multiple>
                            <label class="custom-file-label inputarticle">Выберите файл</label>
                        </div>
                    </div>
                </div>

                <hr class="hrArticleForm">

                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label>Стоимость</label>
                        <input type="number" class="form-control inputarticle" placeholder="Стоимость" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Категория</label>
                        <select-comp :data="category.data"></select-comp>
                        <div class="invalid-tooltip">
                            Пожалуйста выберите категорию объявления.
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Добавить объявление</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                category: {},
                data:{
                    name: null,
                    description: null,
                    img: null,
                    success: false,
                    has_error: false,
                    error: ''
                }
            }
        },
        mounted(){
            axios.get('/category').then(response => {
					this.category = response.data;
                });
        },
        methods:{
            add() {
                axios.post('/addArticle', this.data);
            },
        }
    }
</script>

<style scoped>
    .formarticle{
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

    .inputarticle {
        height: 50px !important;
    }

    .filearticle{
        height: 50px;
    }

    .custom-file-label{
        padding: 5%;
        font-size: 14px;
    }

    .custom-file-label::after{
        height: 49px;
        padding: 5% 5%;
        font-size: 14px;
    }

    .hrArticleForm{
        background:white;
    }

    .btn{
        background-color: #FF6200 !important;
        font-size: 20px;
    }
</style>
