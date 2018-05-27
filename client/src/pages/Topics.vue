<template>
  <v-layout>
    <v-container grid-list-xl>
      <v-layout row wrap>
        <v-flex xs12 md6 lg4 v-for="topic in topics" :key="topic.id">
          <ThemeCard :topic="topic"></ThemeCard>
        </v-flex>
      </v-layout>
    </v-container>
  </v-layout>
</template>

<script>
  import ThemeCard from '../components/ThemeCard.vue';
  export default {
    components: {ThemeCard},
    data: () => ({
      topics: {}
    }),

    created() {
      window.axios.get('/api/themes')
                  .then(response => this.topics = response.data)
                  .catch(error => console.log(error));
    }
  }
</script>