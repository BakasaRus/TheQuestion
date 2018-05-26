import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.css';
import router from './router';
import App from './layouts/App';
import Moment from 'moment';
import VueStash from 'vue-stash';
import Axios from 'axios';

Vue.use(VueStash);
Vue.use(Vuetify);
Vue.use(VueRouter);

Vue.config.devtools = true;
window.moment = Moment;
window.moment.locale('ru');
window.axios = Axios;

window.axios.defaults.baseURL = 'http://localhost:8008';

new Vue({
  router,
  el: '#app',
  render: h => h(App),
  data: {
    store: {
      user: false,
      tokens: false,
      fallback: {
        cover: 'http://verdewall.com/wp-content/uploads/2016/08/Background-Images-4H9.jpg',
        avatar: 'https://cdn0.iconfinder.com/data/icons/shopping-197/48/bl_872_profile_avatar_anonymous_customer_user_head_human-512.png'
      }
    }
  },

  created() {
    if (window.localStorage.getItem('tokens') != null)
    {
      this.store.tokens = JSON.parse(window.localStorage.getItem('tokens'));
      window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.store.tokens.access_token;
      window.axios.get('/api/user')
                  .then(response => this.store.user = response.data)
                  .catch(error => console.log(error));
    }
  }
})