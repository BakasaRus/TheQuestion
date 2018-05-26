<template>
  <v-card hover :to="`/questions/${question.id}`">
    <v-card-media :src="cover" height="300px">
        <v-layout column ma-2 align-center>
          <v-flex text-xs-center>
            <h1 class="white--text">{{ question.text }}</h1>
          </v-flex>
          <v-flex>
            <v-chip small outline color="white" v-for="theme in question.themes" :key="theme.id">{{ theme.name }}</v-chip>
          </v-flex>
        </v-layout>
    </v-card-media>
    <v-card-text v-if="question.answers && question.answers.length">
      <span class="subheading">{{ question.answers[0] | cutAnswer }}</span>
    </v-card-text>
  </v-card>
</template>

<script>
  export default {
    props: ['question'],
    data: () => ({
      fallback: {
        cover: 'http://getwallpapers.com/wallpaper/full/a/3/b/430317.jpg'
      }
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