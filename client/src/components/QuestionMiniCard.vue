<template>
  <v-card hover :to="'/questions/' + question.id">
    <v-card-media :src="cover" height="300px">
      <v-container fill-height fluid>
        <v-layout fill-height>
          <v-flex xs12 align-end>
            <p class="caption grey--text" v-text='question.themes[0].name'></p>
            <span class="title white--text" v-text='question.text'></span>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-media>
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
    }
  }
</script>