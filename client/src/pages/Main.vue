<template>
  <v-layout column>
    <v-container grid-list-xl>
      <v-layout row wrap>
        <v-flex xs12 md6 lg4 v-for="question in questions" :key="question.title">
          <v-card hover>
            <v-card-media src="http://getwallpapers.com/wallpaper/full/a/3/b/430317.jpg" height="300px">
              <v-container fill-height fluid>
                <v-layout fill-height>
                  <v-flex xs12 align-end>
                    <span class="subheading white--text" v-text='question.theme'></span><br>
                    <span class="title white--text" v-text='question.title'></span>
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
                    <span class="title white--text" v-text='question.title'></span>
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
          { title: 'My first question', theme: 'World' },
          { title: 'Interesting question', theme: 'Music' },
          { title: 'What if Russians do not ride on bears?' , theme: 'Russia' },
          { title: 'Another interesting question', theme: 'Music' },
          { title: 'How can we make Tye angry?', theme: 'Life' },
          { title: 'Is Earth flat?', theme: 'Science' }
        ]
      }
    }
  }
</script>
