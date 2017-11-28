import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import VueAnalytics from 'vue-analytics'
import App from './components/App.vue'
import { routes } from './routes'

Vue.use(VueRouter);
Vue.use(VueResource);

// Vue.config.debug = true

// Creating eventBus to handle non-parent-child communication for now
const EventBus = new Vue()
// Attaching it as a global $bus variable
Object.defineProperties(Vue.prototype, {
  $bus: {
    get: () => { return EventBus }
  }
})

const router = new VueRouter({
  routes,
  linkActiveClass: 'active',
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0 }
  },
  mode: 'history' // TODO: Remember to set up the server to ALWAYS serve the index.html file when this history-mode is on (to avoid hashes in the url)
})

router.beforeEach( (to, from, next) => {
  const routeChange = {
    from: from,
    to: to
  }
  EventBus.$emit( 'routeChange', routeChange )
  next()
})

const Folkeklubben = Vue.extend({
  components: { 'app': App },
  data() {
    return {
      routeChange: {}
    }
  },
  created() {
    EventBus.$on( 'routeChange', (routeChange) => { this.routeChange = routeChange })
  },
  mounted() {
    // Facebook embed
    window.fbAsyncInit = function() {
      FB.init({
        xfbml   : true,
        version : 'v2.10'
      });
    };
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/da_DK/sdk.js#xfbml=1&version=v2.10';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  },
  template: '<app :routeChange="routeChange" />'
})

const notLocalhost = window.location.host != 'localhost:8080' ? true : null
if (notLocalhost) { // Only track if not in dev env (localhost)
  Vue.use(VueAnalytics, {
    id: 'UA-78898537-1',
    router
  })
}

new Vue({
  el: '#app',
  router,
  render: h => h(Folkeklubben)
})
