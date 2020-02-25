<template>
<!--    <form ref="auth" method="post" class="modalForm" id="formAuth">-->
<!--        <input type="text" name="email"  placeholder="Почта"><br>-->
<!--        <input type="password"  name="password" placeholder="Пароль"><br>-->
<!--        <input @click="login" type="submit" name="submit" value="Войти" class="runBtn">-->
<!--    </form>-->
    <div class="container" style="margin-top: 5vh">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card card-default" style="background-color: #1F7B67; font-size: 20px;">
                    <div class="card-header" style="text-align: center; font-size: 35px;">Авторизация</div>
                    
                    <div class="card-body">
                        <div class="alert alert-danger" v-if="has_error && !success">
                            <p v-if="error == 'login_error'">Validation Errors.</p>
                            <p v-else>Error, unable to connect with these credentials.</p>
                        </div>
                        <form autocomplete="off" @submit.prevent="login" method="post" id="loginform">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" id="password" class="form-control" v-model="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Войти</button>
                            <a href="/register" id="link">Зарегистрироваться</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",
        data() {
            return {
                email: null,
                password: null,
                success: false,
                has_error: false,
                error: ''
            }
        },
        mounted() {
            //
        },
        methods: {
            login() {
                // get the redirect object
                var redirect = this.$auth.redirect();
                var app = this;
                
                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password
                    },
                    success: function() {
                        // handle redirection
                        app.success = true;
                        const redirectTo = 'dashboard';
                        this.$router.push({name: redirectTo})
                    },
                    error: function() {
                        app.has_error = true;
                        app.error = res.response.data.error
                    },
                    
                })
            },
            
        }
    }
</script>

<style scoped>

.btn{
    background-color: #FF6200 !important;
    font-size: 20px;
 }

.card-header{
    border-bottom: 1px solid white;
}
    #link{
        background-color: #FF6200;
        height: 46px;
        font-size: 20px;
        text-decoration: none;
        color: white;
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        line-height: 1.6;
        border-radius: 0.25rem;
        -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        float: right;
    }
    
</style>