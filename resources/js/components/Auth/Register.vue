<template>
    <div class="container" style="margin-top: 5vh">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <div class="card card-default" style="background-color: #1F7B67; font-size: 20px;">
                    <div class="card-header" style="text-align: center; font-size: 35px;">Регистрация</div>
                    <div class="card-body">
                        <div class="alert alert-danger" v-if="has_error && !success">
                            <p v-if="error == 'registration_validation_error'">Validation Errors.</p>
                            <p v-else>Error, can not register at the moment. If the problem persists, please contact an administrator.</p>
                        </div>
                        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
                                <label for="name">Имя</label>
                                <input type="text" id="name" class="form-control" placeholder="ФИО" v-model="name">
                                <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
                            </div>
                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.phone }">
                                <label for="phone">Телефон</label>
                                <input type="text" id="phone" class="form-control" placeholder="Телефон" v-model="phone">
                                <span class="help-block" v-if="has_error && errors.phone">{{ errors.phone }}</span>
                            </div>
                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
                                <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                            </div>
                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                                <label for="password">Пароль</label>
                                <input type="password" id="password" class="form-control" v-model="password">
                                <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                            </div>
                            <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                                <label for="password_confirmation">Подтверждение пароля</label>
                                <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation">
                            </div>
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                            <router-link to="/login" id="link">Войти</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "register",
        data() {
            return {
                name: '',
                email: '',
                phone: '',
                password: '',
                password_confirmation: '',
                has_error: false,
                error: '',
                errors: {},
                success: false
            }
        },
        methods: {
            register() {
                var app = this;
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        phone: app.phone,
                        password: app.password,
                        password_confirmation: app.password_confirmation
                    },
                    success: function () {
                        app.success = true;
                        this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
                    },
                    error: function (res) {
                        console.log(res.response.data.errors);
                        app.has_error = true;
                        app.error = res.response.data.error;
                        app.errors = res.response.data.errors || {}
                    }

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
