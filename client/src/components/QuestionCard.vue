<template>
  <v-card hover :to="`/questions/${question.id}`">
    <v-card-media :src="cover" height="300px">
        <v-layout column ma-2 align-center justify-center>
          <v-flex text-xs-center style="flex-grow: 0">
            <h1 class="white--text">{{ question.text }}</h1>
            <div>
              <v-chip small outline color="white" v-for="theme in question.themes" :key="theme.id">{{ theme.name }}</v-chip>
            </div>
          </v-flex>
        </v-layout>
    </v-card-media>
    <v-card-text v-if="question.answers && question.answers.length">
      <span class="subheading">{{ question.answers[0].text | cutAnswer }}</span>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    props: ['question'],
    store: ['fallback'],
    data: () => ({
    }),

    computed: {
      cover() {
        return this.question.cover === '' ? this.fallback.cover : this.question.cover;
      }
    },

    filters: {
      cutAnswer(answer) {
        return answer.split(" ").slice(0, 20).join(" ") + " ..."; 
      }
    }
  }
</script>