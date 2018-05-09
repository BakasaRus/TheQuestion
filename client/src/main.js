import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.css'
import router from './router'
import App from './layouts/App'
import Moment from 'moment'
import VueStash from 'vue-stash';

Vue.use(VueStash)
Vue.use(Vuetify)
Vue.use(VueRouter)

Vue.config.devtools = true
window.moment = Moment

new Vue({
  router,
  el: '#app',
  render: h => h(App),
  data: {
    store: {
      user: false,
      server: 'localhost:8008'
    }
  }
})