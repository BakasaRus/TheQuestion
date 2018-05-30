<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card>
          <v-toolbar dark color="primary">
            <v-toolbar-title>Регистрация</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="regForm" v-model="valid">
              <v-text-field
                prepend-icon="mdi-account" 
                name="login" 
                label="Логин" 
                type="text" 
                v-model="submitData.login" 
                :rules="rules.login">
              </v-text-field>
              <v-text-field 
                prepend-icon="mdi-email" 
                name="email" 
                label="E-mail" 
                type="email" 
                v-model="submitData.email" 
                :rules="rules.email">
              </v-text-field>
              <v-text-field 
                prepend-icon="mdi-lock" 
                name="password" 
                label="Пароль" 
                type="password" 
                v-model="submitData.password" 
                :rules="rules.password" 
                counter="10">                  
              </v-text-field>
              <v-text-field 
                prepend-icon="mdi-lock-alert" 
                name="password_confirmation" 
                label="Подверждение пароля" 
                type="password" 
                v-model="submitData.password_confirmation" 
                :rules="rules.password_conf" counter="10">
              </v-text-field>
              <v-text-field 
                name="name" 
                label="Имя" 
                type="text" 
                v-model="submitData.name">
              </v-text-field>
              <v-text-field 
                name="surname" 
                label="Фамилия" 
                type="text" 
                v-model="submitData.surname">
              </v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" to="/login">Уже на сайте?</v-btn>
            <v-btn color="primary" @click="signup" :disabled="!valid">Зарегистрироваться</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <v-snackbar :color="snackbar.color" right v-model="snackbar.visible">
      {{ snackbar.text }}
      <v-btn dark flat @click.native="snackbar.visible = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      valid: false,
      snackbar: {
        visible: false,
        text: '',
        color: 'success'
      },
      submitData: {
        login: '',
        email: '',
        name: '',
        surname: '',
        password: '',
        password_confirmation: ''
      },
      rules: {
        login: [v => !!v || 'Нужно ввести логин'],
        email: [
          v => !!v || 'Нужно ввести e-mail',
          v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v) || 'Нужно ввести корректный e-mail'
        ],
        password: [
          v => !!v || 'Нужно ввести пароль',
          v => v.length >= 10 || 'Пароль должен быть длиной не меньше 10 символов'
        ],
        password_conf: [
          v => !!v || 'Нужно ввести подтверждение пароля',
          v => v.length >= 10 || 'Подтверждение должно быть длиной не меньше 10 символов'
        ],
        name: [v => !!v || 'Нужно ввести имя'],
        surname: [v => !!v || 'Нужно ввести фамилию'],
      }
    }),

    computed: {
      isConfirmed() {
        return this.submitData.password_confirmation == this.submitData.password;
      }
    },

    methods: {
      signup() {
        window.axios.post('/api/users', this.submitData)
                    .then(response => {
                      this.snackbar.text = 'Поздравляем с успешной регистрацией! Войдите в свой аккаунт';
                      this.snackbar.color = 'success';
                      this.snackbar.visible = true;
                      setTimeout(() => {
                        this.$router.push('/login');
                      }, 7000)
                    })
                    .catch(error => {
                      this.snackbar.text = error.message;
                      this.snackbar.color = 'error';
                      this.snackbar.visible = true;
                    });
      }
    }
  }
</script>