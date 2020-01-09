<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" id="topHeader">
                <div class="row">
                    <div id="logo" class="col-md-1">
                        <a href="/"><img id="headerLogo" src="../../img/logo.png" alt=""></a>
                    </div>

                    <div id="searchHeader" class="col-md-4">  
                        <search :searchShow="false"></search>
                        <button @click="showsearch" id="btnShowSearch"  class="btn" type="button">
                            <i class="fa fa-search fa-2x" aria-hidden="true" style="color: white;"></i>
                        </button>
                    </div>

                    <div id="headerMenu" class="col-md-7">
                        <div id="munuPos">
                            <li class="customBtn"><a href="/">главная</a></li>
                            <li class="customBtn"><a href="#" data-toggle="modal" data-target="#myModalAuth">вход</a></li>
                            <li class="addArticle"><a href="">добавить объявление</a></li>
                        </div>                      
                    </div>

                    <ModalHeaderForm></ModalHeaderForm>
                </div>      
            </div>
        </div>
    </div>
</template>

<script>
    import search from './Search.vue';
    import ModalHeaderForm from './ModalHeaderForm.vue';

    export default {
        components: {
            search,
            ModalHeaderForm,
        },
        data(){
            return {
                formStatus: '',
            }
        },
        methods: {
            showsearch: function() {
                document.getElementById('searchBox').style.display = "";
                document.getElementById('btnShowSearch').style.display = "none";
            }
        },
    }
</script>

<style>

    #topHeader{
        height: 110px;
    }

    #headerLogo{
        width: 100px;
        height: 100px;
    }

    #searchHeader{
        margin-top: 20px;
    }

    #headerMenu{
        position: relative;
        margin-top: 15px;
    }

    #munuPos{
        position: absolute;
        right: 10px;
        top: 10px;
        text-align: center;
        color: white;

    }

    .customBtn{
        min-width: 80px;
        text-decoration: none;
        color: white;
        height: 50px;
        float: left;
        list-style-type: none;
        font-size: 22px;
        padding: 5px;
    }
    
    .customBtn a{
        text-decoration: none;
        color: white;
    }

    .customBtn:hover{
        background-color: gray;   
        text-decoration: none;
        color: white;      
    }

    .addArticle{
        text-align: center;
        background-color: #FF6200;
        border-radius: 5px; 
        color: white;
        height: 50px;
        width: 250px;
        float: left;
        list-style-type: none;
        font-size: 23px;
        margin-left: 10px;
        padding: 5px;
    }

    .addArticle:hover{
        background-color: gray;
    }

    .addArticle a{
        color: white;
        text-decoration: none;
    }
</style>