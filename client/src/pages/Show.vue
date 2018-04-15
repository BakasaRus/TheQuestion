<template>
  <v-layout column>
    <v-parallax src="http://getwallpapers.com/wallpaper/full/a/3/b/430317.jpg" height="350">
      <v-container>
      <v-layout column mt-5>
        <h4 class="subheading white--text">{{ question.author }} on {{ question.created_at }}</h4>
        <h1 class="white--text" mt-3>{{ question.title }}</h1>
      </v-layout>
      </v-container>
    </v-parallax>
    <v-container grid-list-xl>
      <v-layout row>
        <v-flex xs8>
          <v-layout column>
            <v-flex xs12 v-for="answer in question.answers">
              <v-card>
                <v-card-title>
                  <span class="body-2">{{ answer.author.name }}</span>&nbsp;
                  <span class="body-1">
                    <v-icon color="green">star</v-icon>
                    <span>{{ answer.author.rating }}</span>
                  </span>&nbsp;
                  <span class="body-1">{{ answer.created_at }}</span>
                </v-card-title>
                <v-card-text>{{ answer.body }}</v-card-text>
                <v-card-actions></v-card-actions>
              </v-card>
            </v-flex>
          </v-layout>
        </v-flex>
        <v-flex xs4>
          <h1>Nice ads here</h1>
        </v-flex>
      </v-layout>
    </v-container>
  </v-layout>
</template>

<script>
  export default {
    data () {
      return {
        question: {
          title: 'Very Interesting Question',
          created_at: 'February 31, 14:88',
          author: 'Anonymous',
          answers: [
            {
              author: {
                name: 'John Doe',
                about: 'MIT Student',
                rating: 265
              },
              created_at: 'March 01, 13:09',
              body: 'More Interesting Answer From Student'
            },
            {
              author: {
                name: 'Jane Doe',
                about: 'Teacher',
                rating: 186
              },
              created_at: 'March 01, 11:23',
              body: 'Informative Answer From Teacher With 23-years Experience'
            }
          ]
        }
      }
    }
  }
</script>
