<template>
  <v-container>
    <v-layout column>
      <v-flex mb-3>
        <span>{{ name }}</span>
        <span color="grey">{{ time }}</span>
      </v-flex>
      <v-form>
        <v-text-field name="text" v-model="text" label="О чём Вы хотите спросить?" counter="140" multi-line rows="7"></v-text-field>
        <v-select v-model="selected" :items="themes" label="Выберите темы" chips tags></v-select>
        <v-switch label="Задать вопрос анонимно" color="primary" v-model="anonymous"></v-switch>
        <v-btn color="primary" class="white--text" @click="submit">
          Задать вопрос
          <v-icon right dark>mdi-send</v-icon>
        </v-btn>
      </v-form>
      <v-snackbar :color="snackbar.color" right v-model="snackbar.visible">
        {{ snackbar.text }}
        <v-btn dark flat @click.native="snackbar.visible = false">Close</v-btn>
      </v-snackbar>
    </v-layout>
  </v-container>
</template>

<script>
  export default {
    store: ['user'],
    data: () => ({
      themes: ['UML', 'ИТМО', 'Программирование', 'Laravel', 'PHP', 'Vue', 'Vuetify'],
      selected: [],
      text: '',
      anonymous: false,
      snackbar: {
        visible: false,
        text: '',
        color: 'success'
      }
    }),

    methods: {
      submit() {
        let submitData = {
          text: this.text,
          themes: this.selected,
          anonymous: this.anonymous
        };
        window.axios.post('/api/questions', submitData)
                    .then(response => {
                      this.snackbar.text = 'Вопрос опубликован! Сейчас мы Вас перенаправим на его страницу';
                      this.snackbar.color = 'success';
                      this.snackbar.visible = true;
                      this.$router.push(`/questions/${response.data.question_id}`);
                    })
                    .catch(error => {
                      this.snackbar.text = error.message;
                      this.snackbar.color = 'error';
                      this.snackbar.visible = true;
                    });
      }
    },

    computed: {
      name() {
        return this.anonymous ? 'Анонимный вопрос' : `${this.user.name} ${this.user.surname}`;
      },

      time() {
        return window.moment().format('DD MMMM, H:mm');
      }
    }
  }
</script>