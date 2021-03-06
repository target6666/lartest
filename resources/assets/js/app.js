
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


import ArticlesList from './components/articles/ArticlesList.vue';
import Categories from './components/categories/Categories.vue';
import Valert from './components/Valert.vue';

export const bus = new Vue();
export const valert = new Vue();
const app = new Vue({
    el: '#app',
    components: {
        'articles-list': ArticlesList,
        'categories': Categories,
        'valert': Valert,
    }
});
