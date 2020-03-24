<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="topHeader">
                <div class="row">
                    <div id="logo" class="col-1">
                        <router-link to="/"><img id="headerLogo" src="../../img/logo.png" alt=""></router-link>
                    </div>

                    <div id="searchHeader" class="col-4">
                        <search :searchShow="searchStatus"></search>
                        <button @click="showsearch" id="btnShowSearch"  class="btn" type="button">
                            <i class="fa fa-search fa-2x" aria-hidden="true" style="color: white;"></i>
                        </button>
                    </div>

                    <div id="headerMenu" class="col-7">
                        <div id="munuPos">
                            <li class="customBtn"><router-link to="/">главная</router-link></li>
                            <li class="customBtn"><router-link to="/login" v-if="!this.$auth.check()">вход</router-link>
                                <a href="#" v-if="this.$auth.check()" @click="logout" style="cursor: pointer">выход</a></li>
                            <li class="addArticle"><router-link to="/addarticle" id="addArticle">добавить объявление</router-link></li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import search from './Widjets/Search.vue';

    export default {

        components: {
            search,
        },
        data(){
            return {
                searchStatus: false,
                user: {},
            }
        },
        methods: {
            showsearch() {
                document.getElementById('searchBox').style.display = "";
                document.getElementById('btnShowSearch').style.display = "none";
                this.searchStatus = true;
            },

            logout() {
                this.$auth.logout({
                    makeRequest: true,
                    success() {
                        console.log('success ' + this.context);
                    },
                    error() {
                        console.log('error ' + this.context);
                    }
                });
            },
        },
    }
</script>

<style>
    
    body{
        width: 100%;
        color: white;
        background: url('../../img/backgroundimg.png') repeat-y center center fixed;
        background-size: cover;
        background-attachment: fixed;
        background-color: rgba(0,0,0,.8);
        background-blend-mode: darken;
    }
    
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
    
    .hideSearch{
    
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
