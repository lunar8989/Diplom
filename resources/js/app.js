/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

//import components

import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import auth from './auth'
import router from './router'
import 'jquery'
import 'bootstrap-select/dist/js/bootstrap-select'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VSelect from '@alfsnd/vue-bootstrap-select'




window.Vue = Vue;


//router
Vue.router = router;
Vue.use(VueRouter);

//http-axios
Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'http://localhost:8000/api';

//auth
Vue.use(VueAuth, auth);

//bootvue
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('header-comp', require('./components/Header.vue').default);
Vue.component('search-comp', require('./components/Widjets/Search.vue').default);
Vue.component('select-comp', require('./components/Widjets/Select.vue').default);
Vue.component('slider-comp', require('./components/Widjets/Slider.vue').default);
Vue.component('main-comp', require('./components/MainPage.vue').default);
Vue.component('board-comp', require('./components/Articles/Board.vue').default);
Vue.component('footer-comp', require('./components/Footer.vue').default);
Vue.component('map-comp', require('./components/Widjets/Map').default);
Vue.component('v-select', VSelect);

Vue.component('pagination', require('laravel-vue-pagination'));



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
