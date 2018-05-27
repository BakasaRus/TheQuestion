import VueRouter from 'vue-router'

const routes = [
  { path: '/', component: require('./pages/Main.vue').default },
  { path: '/questions/ask', component: require('./pages/Ask.vue').default },
  { path: '/questions/:id', component: require('./pages/Show.vue').default, props: true },
  { path: '/users/:id', component: require('./pages/User.vue').default, props: true },
  { path: '/login', component: require('./pages/Login.vue').default },
  { path: '/404', component: require('./pages/404.vue').default },
  { path: '/topics', component: require('./pages/Topics.vue').default }
]

export default new VueRouter({
  routes,
  linkActiveClass: '',
  linkExactActiveClass: ''
})

