<template>
    <div class="container" style="margin-top: 5vh">
        <div class="row justify-content-sm-center">
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
                            <router-link to="/register" id="link">Зарегистрироваться</router-link>
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
                error: '',
                user: {},
            }
        },
        methods: {
            login() {
                // get the redirect object
                var app = this;
                axios.get('/user', { params: { email: app.email } })
                    .then(response => {
                        this.user = response.data;
                    });
                
                this.$auth.login({
                    data: {
                        email: app.email,
                        password: app.password,
                    },
                    success: function() {
                        // handle redirection
                        app.success = true;
                        
                        if(this.user.name === 'admin'){
                            this.$router.push({name: 'adminDashboard', params: { userId: this.user.id }});
                        }else{
                            this.$router.push({name: 'Dashboard', params: { userId: this.user.id}});
                        }
                    },
                    error: function(res) {
                        app.has_error = true;
                        app.error = res.response.data.error
                    },
                    rememberMe: true,
                    fetchUser: true
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
