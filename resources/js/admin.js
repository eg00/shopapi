import VueRouter from 'vue-router';
import App from './admin/App.vue';
import routes from './admin/routes';

require('./bootstrap');
const Vue = require('vue');

Vue.use(VueRouter);
Vue.prototype.axios = window.axios;

const router = new VueRouter({
  mode: 'history',
  routes,
});

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  router,
  render: (h) => h(App),
}).$mount('#app');
