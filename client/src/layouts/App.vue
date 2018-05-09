<template>
  <v-app>
    <v-toolbar fixed app>
      <v-toolbar-title v-text="title"></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon large>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
      <v-btn icon large>
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn icon large>
        <v-icon>mdi-bell</v-icon>
      </v-btn>
      <v-btn icon large v-if="this.user">
        <v-icon >mdi-account-circle</v-icon>
      </v-btn>      
      <v-btn icon large v-else>
        <v-icon>mdi-login</v-icon>
      </v-btn>
    </v-toolbar>
    <v-content>
      <router-view></router-view>
    </v-content>
    <v-footer height="auto" class="grey darken-3">
      <v-layout row wrap justify-center>
        <v-flex xs12 py-3 text-xs-center white--text>
          &copy;2018 — <strong>{{ title }}</strong>
        </v-flex>
      </v-layout>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    store: ['user'],
    data () {
      return {
        title: 'The Question'
      }
    }
  }
</script>
