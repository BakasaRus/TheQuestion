<template>
  <v-layout column>
    <v-container grid-list-xl>
      <v-layout row wrap>
        <v-flex xs12 md6 lg4 v-for="question in questions" :key="question.title">
          <v-card hover :to="'question/' + question.id">
            <v-card-media src="http://getwallpapers.com/wallpaper/full/a/3/b/430317.jpg" height="300px">
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
        </v-flex>
      </v-layout>
    </v-container>
    <v-container grid-list-xl>
      <span class="headline">Telegram</span>
      <v-layout row wrap>
        <v-flex xs12 md4 lg2 v-for="question in questions" :key="question.title">
          <v-card>
            <v-card-media src="http://getwallpapers.com/wallpaper/full/a/3/b/430317.jpg" height="300px">
              <v-container fill-height fluid>
                <v-layout fill-height>
                  <v-flex xs12 align-end flexbox>
                    <span class="title white--text" v-text='question.text'></span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-media>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-layout>
</template>

<script>
  export default {
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
