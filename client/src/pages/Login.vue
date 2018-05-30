<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card>
          <v-toolbar dark color="primary">
            <v-toolbar-title>Вход на сайт</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field prepend-icon="mdi-account" name="email" label="Email" type="text" v-model="email"></v-text-field>
              <v-text-field id="password" prepend-icon="mdi-lock" name="password" label="Пароль" type="password" v-model="password"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary">Забыли пароль?</v-btn>
            <v-btn color="primary" @click="login">Войти</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  export default {
    store: ['user', 'tokens'],
    data: () => ({
      email: '',
      password: ''
    }),
    methods: {
      login() {
        let data = {
        'grant_type': 'password',
        'client_id': 2,
        'client_secret': 'd5dcmP23gkRkwWjasSnnxEW6tETEAq46cA0P1nOk',
        'username': this.email,
        'password':  this.password,
        'scope': '',
        };
        window.axios.post('/oauth/token', data)
                    .then(response => {
                      this.tokens = response.data;
                      window.localStorage.setItem('tokens', JSON.stringify(this.tokens));
                      window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.tokens.access_token;
                      window.axios.get('/api/user')
                                  .then(response => this.user = response.data)
                                  .catch(error => console.log(error));
                      this.$router.push('/');
                    })
                    .catch(error => console.log(error));
      }
    }
  }
</script>