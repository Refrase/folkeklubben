import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import App from './components/App.vue'
import { routes } from './routes'

Vue.use(VueRouter);
Vue.use(VueResource);

// Vue.config.debug = true

const router = new VueRouter({
  routes,
  linkActiveClass: 'active',
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  },
  mode: 'history' // TODO: Remember to set up the server to ALWAYS serve the index.html file when this history-mode is on (to avoid hashes in the url)
})

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
