import VueRouter from 'vue-router'

const routes = [
  { path: '/', component: require('./pages/Main.vue').default },
  { path: '/show-question', component: require('./pages/Show.vue').default },
  { path: '/user', component: require('./pages/User.vue').default }
]

export default new VueRouter({
  routes
})

