<template>
  <v-jumbotron
    :gradient="gradient"
    src="/public/fallbackBG.jpg"
    dark
    height="100%"
  >
    <v-container fill-height>
      <v-layout align-center>
        <v-flex text-xs-center>
          <h3 class="display-3">Упс, такой страницы нет</h3>
          <v-btn large outline color="white" to="/">На главную</v-btn>
        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
</template>

<script>
  export default {
    data: () => ({
      gradient: '#00000044, #00000044'
    })
  }
</script>