<template>
  <v-card flat color="transparent">
    <v-card-title>
      <v-layout row>
        <v-flex>
          <v-avatar size="40px" color="white">
            <img :src="avatar" :alt="comment.author.name">
          </v-avatar>
        </v-flex>
        <v-flex xs12>
          <span class="body-2">{{ comment.author.name }} {{ comment.author.surname }}</span>&nbsp;
          <span class="body-1">
            <v-icon color="green">mdi-star-outline</v-icon>
            <span>{{ comment.author.rating }}</span>
          </span>&nbsp;
          <span class="body-1">{{ comment.created_at | readable }}</span><br>
          <span class="body-1">{{ comment.author.about }}</span>
        </v-flex>
      </v-layout>
    </v-card-title>
    <v-card-text class="whitespace">{{ comment.text }}</v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn icon small><v-icon :color="comment.like === true ? 'green' : ''">mdi-thumb-up-outline</v-icon></v-btn>
      <span class="caption">{{ comment.rating }}</span>
      <v-btn icon small><v-icon :color="comment.like === false ? 'red' : ''">mdi-thumb-down-outline</v-icon></v-btn>
      <v-spacer></v-spacer>
      <v-btn icon small dark color="light-blue darken-3"><v-icon>mdi-vk</v-icon></v-btn>
      <v-btn icon small dark color="light-blue darken-4"><v-icon>mdi-facebook</v-icon></v-btn>
      <v-btn icon small dark color="light-blue accent-4"><v-icon>mdi-telegram</v-icon></v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    props: ['comment'],
    store: ['fallback'],

    computed: {
      avatar() {
        return this.comment.author.avatar === '' ? this.fallback.avatar : this.comment.author.avatar;
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