<template>
    <div id="topHeader">
        <div class="content">
            <div class="header_body">
                <div id="logo">
                    <router-link to="/"><img id="headerLogo" src="../../img/logo.svg" alt=""></router-link>
                </div>
    
                <div id="searchHeader">
                    <search :searchShow="searchStatus"></search>
                    <button @click="showsearch" id="btnShowSearch"  class="btn" type="button">
                        <i class="fa fa-search fa-2x" aria-hidden="true" style="color: white;"></i>
                    </button>
                </div>
    
                <div class="header_burger" v-on:click="burger($event)">
                    <span></span>
                </div>
    
                <div id="headerMenu">
                    <ul id="munuPos">
                        <li class="customBtn" v-if="this.user"><a @click="dashboard" style="cursor: pointer">личный кабинет</a></li>
                        <li class="customBtn"><router-link to="/login" v-if="!this.$auth.check()">вход</router-link>
                            <a href="#" v-if="this.$auth.check()" @click="logout" style="cursor: pointer">выход</a></li>
                        <li class="addArticle"><router-link to="/addarticle" id="addArticle">добавить объявление</router-link></li>
                    </ul>
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
                userSuccess: false,
            }
        },
        updated(){
            if (this.$auth.check() && this.userSuccess !== true){
                axios.get('/authUser').then(response => {
                    this.user = response.data;
                });
                this.userSuccess = true;
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
    
            dashboard(){
                this.$router.push({ name: 'Dashboard', params: { userId: this.user.id}});
            },
    
            burger(event){
                $('.header_burger, #headerMenu').toggleClass('active');
                $('body').toggleClass('lock');
            },
        },
    }
</script>

<style lang="scss">
    
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
        width: 100%;
        top: 0;
        left: 0;
        z-index: 50;
        &:before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 2;
        }
    }

    .header_body{
        width: 100%;
        position: relative;
        display: flex;
        height: 115px;
        justify-content: space-between;
        align-items: center;
    }
    
    .content{
        width: 100%;
        margin: 0 auto;
        padding: 0 10px;
    }

    #logo{
        flex: 0 0 7%;
        position: relative;
        z-index: 3;
        a{
            img{
            width: 100%;
            min-width: 70px;}
        }
        
    }

    #searchHeader{
        flex: 0 0 23%;
        margin-top: 20px;
        position: relative;
        z-index: 3;
    }

    #headerMenu{
        flex: 0 0 70%;
        margin-top: 15px;
        position: relative;
        z-index: 3;
        padding: 15px;
        display: flex;
        justify-content: flex-end !important;
        
    }

    #munuPos{
        flex: 0 0 50%;
        margin: 15px;
        text-align: center;
        color: white;
        display: flex;
    }

    .customBtn{
        &:first-child{
            flex: 0 0 25%;
            white-space: nowrap;
        }
        flex: 0 0 20%;
        text-decoration: none;
        color: white;
        border-radius: 5px;
        height: 50px;
        list-style-type: none;
        font-size: 1.5rem;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        a{
            text-decoration: none;
            color: white;
        }
        &:hover{
            background-color: gray;
            text-decoration: none;
            color: white;}
    }

    .addArticle{
        flex: 0 0 55%;
        text-align: center;
        background-color: #FF6200;
        border-radius: 5px;
        color: white;
        height: 50px;
        font-size: 1.5rem;
        padding: 5px;
        list-style-type: none;
        display: flex;
        align-items: center;
        justify-content: center;
        a{
            color: white;
            text-decoration: none;
        }
        &:hover{
            background-color: gray;
        }
    }
    
    .header_burger{
        display: none;
    }
    
    .header_burger.active {
        &:before {
            transform: rotate(45deg);
            top: 9px;
        }
        &:after {
            transform: rotate(-45deg);
            bottom: 9px;
        }
        span{
            transform: scale(0);
        }
    }
    
    @media(max-width: 767px){
        body.lock{
            overflow: hidden;
        }
        
        .header_body{
            height: 70px;
        }
    
        .header_burger{
            display: block;
            position: relative;
            width: 30px;
            height: 20px;
            z-index: 3;
            &:before, &:after{
                content: '';
                background-color: black;
                position: absolute;
                width: 100%;
                height: 2px;
                left: 0;
                transition: all 0.3s ease 0s;
            }
            &:before{
                top: 0;
            }
            &:after{
                bottom: 0;
            }
            span{
                position: absolute;
                background-color: black;
                left: 0;
                width: 100%;
                height: 2px;
                top: 9px;
                transition: all 0.3s ease 0s;
            }
        }
    
        #logo{
            position: relative;
            z-index: 3;
        }
    
        #headerMenu{
            position: fixed;
            top: -120%;
            left: 0;
            width: 100%;
            height: 100%;
            transition: all 0.3s ease 0s;
            background-color: #2CAF93;
            z-index: 3;
            overflow: auto;
            margin-top: 70px;
            &.active{
                top: 0;
            }
        }
    
        #munuPos{
            flex: 0 0 100%;
            display: block;
            font-size: 30px;
            float: none
        }
    
        .customBtn{
            width: 70%;
            margin: 0 auto;
        }
    
        .addArticle{
            width: 70%;
            margin: 0 auto;
        }
    
        #topHeader{
            background-color: #1F7B67;
        }
    
        #searchHeader{
            display: none;
        }
    
    }
    
</style>
