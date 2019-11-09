require('./bootstrap');

window.Vue = require('vue');

Vue.component('article', require('./components/Article.vue'));

const app = new Vue({
    el: '#app'
});

//Requiring bulma extensisions.
require('./navbar-script.js')
require('./bulma-extensions');
