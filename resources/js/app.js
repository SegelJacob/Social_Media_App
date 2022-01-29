import Vue from 'vue';
import router from './router';
import App from './components/App'

require('./bootstrap');


const app = new Vue({
    el: '#app',

    component: {
        App
    },

    router,
    // render: h => h(App)
});
