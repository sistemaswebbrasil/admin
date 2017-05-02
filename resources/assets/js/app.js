import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import CervejariaIndex from './components/index.vue';
import CervejariaCreate from './components/create.vue';

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    {
      path: '/',
      component: CervejariaIndex
    },
    {
      path: '/cervejarias/create',
      component: CervejariaCreate
    }
  ]
})

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})


// require('./bootstrap');

// window.Vue = require('vue');

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });
