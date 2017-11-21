
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueCookie = require('vue-cookie');

Vue.use(VueCookie);

import Datatable from 'vue2-datatable-component/dist/min.js'
import locale from './locale/ru-ru'

Vue.use(Datatable, { locale })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('objects-surfing', require('./components/objects-surfing.vue'));

const app = new Vue({
    el: '#app'
});
