import VueRouter from 'vue-router'

const routes = [
  { path: '/', component: require('./pages/Main.vue').default },
  { path: '/question/ask', component: require('./pages/Ask.vue').default },
  { path: '/question/:id', component: require('./pages/Show.vue').default, props: true },
  { path: '/user/:id', component: require('./pages/User.vue').default },
  { path: '/login', component: require('./pages/Login.vue').default }
]

export default new VueRouter({
  routes,
  linkActiveClass: '',
  linkExactActiveClass: ''
})

