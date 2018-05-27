<template>
  <v-card :color="color" hover :to="'/topics/' + topic.id">
    <v-card-media height="200px">
      <v-container fill-height fluid>
        <v-layout fill-height align-center justify-center>
          <v-flex xs12 text-xs-center>
            <h1 class="white--text">{{ topic.name }}</h1>
          </v-flex>
        </v-layout>
      </v-container>
    </v-card-media>
  </v-card>
</template>

<script>
  export default {
    props: ['topic'],

    computed: {
      color() {
        let res = '';
        switch (this.topic.id % 7) {
          case 0: res = 'green'; break;
          case 1: res = 'blue'; break;
          case 2: res = 'purple'; break;
          case 3: res = 'red'; break;
          case 4: res = 'brown'; break;
          case 5: res = 'lime'; break;
          case 6: res = 'cyan'; break;
        }
        return res;
      }
    }
  }
</script>