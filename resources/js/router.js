import VueRouter from 'vue-router';
// Pages
import MainPage from './components/MainPage';
import Register from './components/Auth/Register';
import Login from './components/Auth/Login';
import Dashboard from './components/User/Dashboard';
import AddArticle from "./components/Articles/AddArticle";
import ArticlePage from "./components/Articles/ArticlePage";
import Admin from './components/Admin/Dashboard';
import SearchPage from "./components/Articles/SearchPage";

// Routes
const routes = [
    {
        path: '/',
        name: 'MainPage',
        component: MainPage,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '/addarticle',
        name: 'AddArticle',
        component: AddArticle,
        meta: {
            auth: true
        }
    },
    {
        path: '/article/:articleId',
        name: 'Article',
        component: ArticlePage,
    },
    {
        path: '/searchpage',
        name: 'Searching',
        component: SearchPage,
        props: (route) => ({ filters: Object(route.params.filters) }),
    },
    // users
    {
        path: '/user/dashboard/:userId',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    // admin
    {
        path: '/admin/dashboard/:userId',
        name: 'adminDashboard',
        component: Admin,
        meta: {
            auth: true
        }
    },

];
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
});


export default router
