import '../css/app.css';
import App from './App.vue';
import router from "./routes";
import store from './store';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

Vue.component('App', App);

// const router = new VueRouter({
//     routes // short for `routes: routes`
// })

var app = new Vue({
    router,
    store
}).$mount('#app');
