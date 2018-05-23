<template>
  <v-layout column>
    <v-container>
      <v-layout column mb-3>
        <v-header>{{ name }}</v-header>
        <v-header color="grey">{{ time }}</v-header>
      </v-layout>
      <v-form>
        <v-text-field name="text" v-model="text" label="О чём Вы хотите спросить?" counter="140" multi-line rows="7"></v-text-field>
        <v-select v-model="selected" :items="themes" label="Выберите темы" chips tags></v-select>
        <v-switch label="Задать вопрос анонимно" color="primary" v-model="anonymous"></v-switch>
        <v-btn color="primary" class="white--text">
          Задать вопрос
          <v-icon right dark>mdi-send</v-icon>
        </v-btn>
      </v-form>
    </v-container>
  </v-layout>
</template>

<script>
  export default {
    store: ['user'],
    data: () => ({
      themes: ['UML', 'ИТМО', 'Программирование', 'Laravel', 'PHP', 'Vue', 'Vuetify'],
      selected: [],
      text: '',
      anonymous: false
    }),

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