
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

window.Vue = require('vue');

Vue.prototype.trans = string => _.get(i18n, string);

window.Vuetify = require('vuetify');

Vue.use(require('vuetify'));

import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('login', require('./components/Login.vue'));
Vue.component('busca', require('./components/Busca.vue'));
Vue.component('cadastro', require('./components/Cadastro.vue'));
Vue.component('edicao', require('./components/Edicao.vue'));

import App from './components/App.vue';

import Usuario from './views/usuarios/Search.vue';
import UsuarioCreate from './views/usuarios/Create.vue';
import UsuarioEdit from './views/usuarios/Edit.vue';

import Home from './views/Home.vue';
import Login from './views/Login';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'Login',
            component: Login,
        },
        {
            path: '/home',
            name: 'Início',
            component: Home,
        },
        {
            path: '/usuarios',
            name: 'Buscar Usuários',
            component: Usuario,
        },
        {
            path: '/usuarios/create',
            name: 'Cadastrar Usuário',
            component: UsuarioCreate
        },
        {
            path: '/usuarios/:id/edit',
            name: 'Editar Usuário',
            component: UsuarioEdit,
        }

    ],
});

const opts = {
    icons: {
        iconfont: 'mdi'
    }
};
let vuetify = new Vuetify(opts);

const app = new Vue({
    el: '#app',
    vuetify,
    components: { App },
    router
});
