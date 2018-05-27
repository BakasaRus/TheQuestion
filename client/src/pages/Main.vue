<template>
  <v-layout column>
    <v-container grid-list-xl>
      <v-layout row wrap>
        <v-flex xs12 md6 lg4 v-for="question in questions" :key="question.id">
          <QuestionMiniCard :question="question"></QuestionMiniCard>
        </v-flex>
      </v-layout>
    </v-container>
    <v-container grid-list-xl>
      <span class="headline">Telegram</span>
      <v-layout row wrap>
        <v-flex xs12 md6 lg3 v-for="question in questions" :key="question.id">
          <QuestionMiniCard :question="question"></QuestionMiniCard>
        </v-flex>
      </v-layout>
    </v-container>
  </v-layout>
</template>

<script>
  import QuestionMiniCard from '../components/QuestionMiniCard.vue';
  export default {
    components: {QuestionMiniCard},
    data () {
      return {
        questions: [
        ]
      }
    },

    created() {
      window.axios.get('/api/questions')
                  .then(response => this.questions = response.data)
                  .catch(error => console.log(error));
    }
  }
</script>
