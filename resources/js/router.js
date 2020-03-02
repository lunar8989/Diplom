import VueRouter from 'vue-router';
// Pages
import MainPage from './components/MainPage';
import Register from './components/Auth/Register';
import Login from './components/Auth/Login';
import Dashboard from './components/User/Dashboard';
import AddArticle from "./components/Articles/AddArticle";
import ArticlePage from "./components/Articles/ArticlePage";

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
        path: 'article/:id',
        name: 'Article',
        component: ArticlePage,
    },
    // USER ROUTES
    {
        path: 'user/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    
];
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});
export default router
