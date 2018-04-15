<template>
  <v-layout column>
    <v-container grid-list-xl>
      <v-layout row wrap>
        <v-flex xs4 v-for="question in questions" :key="question.title">
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
        <v-flex xs2 v-for="question in questions" :key="question.title">
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
    <v-container grid-list-xl>
      <span class="headline">Russia</span>
      <v-layout row wrap>
        <v-flex xs2 v-for="question in questions" :key="question.title">
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
          { title: 'My First Question', theme: 'World' },
          { title: 'Interesting Question', theme: 'Music' },
          { title: 'What If Russians Does Not Ride On Bears?' , theme: 'Russia' },
          { title: 'Another Interesting Question', theme: 'Music' },
          { title: 'How We Can Make Tye Angry?', theme: 'Life' },
          { title: 'Is Earth Flat?', theme: 'Science' }
        ]
      }
    }
  }
</script>
