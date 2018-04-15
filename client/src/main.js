import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.css'
import router from './router'
import App from './layouts/App'

Vue.use(Vuetify)
Vue.use(VueRouter)

Vue.config.devtools = true

new Vue({
  router,
  el: '#app',
  render: h => h(App)
})