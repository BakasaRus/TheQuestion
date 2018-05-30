<template>
  <v-app>
    <v-toolbar fixed app>
      <v-toolbar-title>The Answer</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-tooltip bottom>
        <v-btn icon large slot="activator" to="/"><v-icon>mdi-home</v-icon></v-btn>
        <span>На главную</span>
      </v-tooltip>
      <v-tooltip bottom>
        <v-btn icon large slot="activator" to="/topics"><v-icon>mdi-shape-outline</v-icon></v-btn>
        <span>Все темы</span>
      </v-tooltip>
      <v-tooltip bottom>
        <v-btn icon large slot="activator"><v-icon>mdi-magnify</v-icon></v-btn>
        <span>Поиск</span>
      </v-tooltip>
      <v-tooltip bottom>
        <v-btn icon large to="/questions/ask" slot="activator"><v-icon>mdi-pencil</v-icon></v-btn>
        <span>Задать вопрос</span>
      </v-tooltip>
      <v-tooltip bottom>
        <v-btn icon large slot="activator"><v-icon>mdi-bell</v-icon></v-btn>
        <span>Уведомления</span>
      </v-tooltip>
      <template v-if="this.user">
        <v-tooltip bottom>
          <v-btn icon large :to="'/users/' + this.user.id" slot="activator"><v-icon >mdi-account-circle</v-icon></v-btn>
          <span>{{ this.user.name }} {{ this.user.surname }}</span>
        </v-tooltip>
        <v-tooltip bottom>
          <v-btn icon large @click="logout" slot="activator"><v-icon>mdi-logout</v-icon></v-btn>
          <span>Выйти</span>
        </v-tooltip>
      </template>
      <template v-else>
        <v-tooltip bottom>
          <v-btn icon large to="/signup" slot="activator"><v-icon>mdi-account-plus</v-icon></v-btn>
          <span>Зарегистрироваться</span>
        </v-tooltip>
        <v-tooltip bottom>
          <v-btn icon large to="/login" slot="activator"><v-icon>mdi-login</v-icon></v-btn>
          <span>Войти</span>
        </v-tooltip>
      </template>
    </v-toolbar>
    <v-content>
      <router-view></router-view>
    </v-content>
    <v-footer height="auto" class="grey darken-3">
      <v-layout row wrap justify-center>
        <v-flex xs12 py-3 text-xs-center white--text>
          &copy;2018 — <strong>The Answer</strong>
        </v-flex>
      </v-layout>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    store: ['user'],
    data () {
      return {
      }
    },

    methods: {
      logout() {
        window.axios.get('/api/logout')
            .then(response => {
              this.tokens = false;
              this.user = false;
              window.localStorage.removeItem('tokens');
              window.axios.defaults.headers.common['Authorization'] = '';
            })
            .catch(error => console.log(error));
      }
    }
  }
</script>
