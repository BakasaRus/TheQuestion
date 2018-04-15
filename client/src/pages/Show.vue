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
            <v-flex xs12 v-for="answer in question.answers" :key="answer.body">
              <v-card>
                <v-card-title>
                  <v-layout row>
                    <v-flex xs1>
                      <v-avatar size="50px">
                        <img :src="answer.author.avatar" :alt="answer.author.name">
                      </v-avatar>
                    </v-flex>
                    <v-flex xs10>
                      <span class="body-2">{{ answer.author.name }}</span>&nbsp;
                      <span class="body-1">
                        <v-icon color="green">mdi-star-outline</v-icon>
                        <span>{{ answer.author.rating }}</span>
                      </span>&nbsp;
                      <span class="body-1">{{ answer.created_at }}</span><br>
                      <span class="body-1">{{ answer.author.about }}</span>
                    </v-flex>
                  </v-layout>
                </v-card-title>
                <v-card-text>{{ answer.body }}</v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-btn icon small><v-icon :color="answer.like === true ? 'green' : ''">mdi-thumb-up-outline</v-icon></v-btn>
                  <span class="caption">{{ answer.rating }}</span>
                  <v-btn icon small><v-icon :color="answer.like === false ? 'red' : ''">mdi-thumb-down-outline</v-icon></v-btn>
                  <v-spacer></v-spacer>
                  <v-btn icon small dark color="light-blue darken-3"><v-icon>mdi-vk</v-icon></v-btn>
                  <v-btn icon small dark color="light-blue darken-4"><v-icon>mdi-facebook</v-icon></v-btn>
                  <v-btn icon small dark color="light-blue accent-4"><v-icon>mdi-telegram</v-icon></v-btn>
                </v-card-actions>
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
                rating: 265,
                avatar: 'public/avatars/avatar-01.png'
              },
              created_at: 'March 01, 13:09',
              body: 'More Interesting Answer From Student',
              rating: 113,
              like: false
            },
            {
              author: {
                name: 'Jane Doe',
                about: 'Teacher',
                rating: 186,
                avatar: 'public/avatars/avatar-05.png'
              },
              created_at: 'March 01, 11:23',
              body: 'Informative Answer From Teacher With 23-years Experience',
              rating: 124
            },
            {
              author: {
                name: 'Taylor Otwell',
                about: 'Creator of Laravel',
                rating: 9000,
                avatar: 'public/avatars/avatar-07.png'
              },
              created_at: 'March 01, 11:23',
              body: 'The Best Answer From The Best PHP Developer',
              rating: 435,
              like: true
            }
          ]
        }
      }
    }
  }
</script>
