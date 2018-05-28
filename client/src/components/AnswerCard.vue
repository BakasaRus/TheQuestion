<template>
  <v-card>
    <v-card-title>
      <v-layout row>
        <v-flex>
          <v-avatar size="50px">
            <img :src="avatar" :alt="answer.author.name">
          </v-avatar>
        </v-flex>
        <v-flex xs12>
          <span class="body-2">{{ answer.author.name }} {{ answer.author.surname }}</span>&nbsp;
          <span class="body-1">
            <v-icon color="green">mdi-star-outline</v-icon>
            <span>{{ answer.author.rating }}</span>
          </span>&nbsp;
          <span class="body-1">{{ answer.created_at | readable }}</span><br>
          <span class="body-1">{{ answer.author.about }}</span>
        </v-flex>
      </v-layout>
    </v-card-title>
    <v-card-text class="whitespace">
    	<p>{{ answer.text }}</p>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn icon small><v-icon :color="answer.like === true ? 'green' : ''">mdi-thumb-up-outline</v-icon></v-btn>
      <span class="caption">{{ answer.rating }}</span>
      <v-btn icon small><v-icon :color="answer.like === false ? 'red' : ''">mdi-thumb-down-outline</v-icon></v-btn>
      <v-btn flat :to="`/answers/${answer.id}/comments`">
        <v-icon :left="$vuetify.breakpoint.smAndUp">mdi-comment-text-multiple-outline</v-icon>
        <span v-if="$vuetify.breakpoint.smAndUp">Комментировать</span>
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn icon small dark color="light-blue darken-3"><v-icon>mdi-vk</v-icon></v-btn>
      <v-btn icon small dark color="light-blue darken-4"><v-icon>mdi-facebook</v-icon></v-btn>
      <v-btn icon small dark color="light-blue accent-4"><v-icon>mdi-telegram</v-icon></v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    props: ['answer'],
    store: ['fallback'],

    computed: {
      avatar() {
        return this.answer.author.avatar === '' ? this.fallback.avatar : this.answer.author.avatar;
      }
    },

    filters: {
      readable(date) {
        if (date === null) return 'когда-то';
        return window.moment(date).fromNow();
      }
    }
  }
</script>

<style>
  .whitespace {
    white-space: pre-line;
  }
</style>