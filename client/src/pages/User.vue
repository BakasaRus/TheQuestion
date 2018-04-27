<template>
  <v-layout column>
    <v-flex xs12 :style="coverStyle">
      <v-container>
        <v-layout column justify-end style="min-height: 300px;">
          <v-flex xs12>
            <v-layout row align-end>
              <v-avatar size="200px" style="margin-bottom: -50px; z-index: 1">
                <img :src="user.avatar">
              </v-avatar>
              <v-layout column mx-5>
                <h1 class="display-2 white--text">{{ user.name }}</h1>
                <span class="subheading white--text">{{ user.about }}</span>
              </v-layout>
              <v-layout column ml-5 align-end>
                <span class="subheading white--text">Rating</span>
                <span class="display-3 white--text">{{ user.rating }}</span>
              </v-layout>
            </v-layout>
          </v-flex>
          <v-flex xs12 mt-3 style="margin-bottom: -50px">
            <v-card>
              <v-toolbar card style="padding-left: 200px">
                <v-btn flat>
                  <v-badge color="primary">
                    <span slot="badge" dark small v-if="user.questions" v-text="user.questions"></span>
                    <v-icon>mdi-comment-question-outline</v-icon>
                    <span>&nbsp;Questions</span>
                  </v-badge>
                </v-btn>
                <v-btn flat>
                  <v-badge color="primary">
                    <span slot="badge" dark small v-if="user.answers" v-text="user.answers"></span>
                    <v-icon>mdi-comment-check-outline</v-icon>
                    <span>&nbsp;Answers</span>
                  </v-badge>
                </v-btn>
                <v-btn flat>
                  <v-badge color="primary">
                    <span slot="badge" dark small v-if="user.subscribers" v-text="user.subscribers"></span>
                    <v-icon>mdi-account-multiple-outline</v-icon>
                    <span>&nbsp;Subscribers</span>
                  </v-badge>
                </v-btn>
                <v-btn flat>
                  <v-badge color="primary">
                    <span slot="badge" dark small v-if="user.subscribtions" v-text="user.subscribtions"></span>
                    <v-icon>mdi-bell-ring-outline</v-icon>
                    <span>&nbsp;Subscribtions</span>
                  </v-badge>
                </v-btn>
                <v-spacer></v-spacer>
                <v-menu bottom left>
                  <v-btn icon slot="activator">
                    <v-icon>mdi-dots-vertical</v-icon>
                  </v-btn>
                  <v-list>
                    <v-list-tile @click="">
                      <v-list-tile-title>Abuse</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="">
                      <v-list-tile-title>Deactivate</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="">
                      <v-list-tile-title>Change profile</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile @click="">
                      <v-list-tile-title>Change cover</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-menu>
              </v-toolbar>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-flex>
    <v-container grid-list-xl mt-5>
      <v-layout row>
        <v-flex xs8>
          <v-layout column>
            <v-flex xs12 v-for="question in questions" :key="question.title">
              <v-card hover>
                <v-card-media src="http://getwallpapers.com/wallpaper/full/a/3/b/430317.jpg" height="300px">
                    <v-layout column ma-2 align-content-space-between>
                      <v-flex xs12>
                        <span class="display-1 white--text" v-text='question.title'></span>
                      </v-flex>
                      <v-flex xs12>
                        <v-chip small outline color="white" v-for="theme in question.themes" :key="theme">{{ theme }}</v-chip>
                      </v-flex>
                    </v-layout>
                </v-card-media>
                <v-card-text>
                  <span class="subheading">{{ question.answer | cutAnswer }}</span>
                </v-card-text>
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
        curTab: null,
        user: {
          name: 'John Doe',
          about: 'Vestibulum sem metus, tempus vel nisl nec, tristique dapibus enim. Maecenas aliquet nisl vel ante dapibus convallis. Vestibulum maximus ligula nec odio laoreet, nec hendrerit ipsum dictum. Donec ut augue vestibulum diam blandit aliquet.',
          rating: 265,
          avatar: 'https://pp.userapi.com/c836629/v836629663/7fbc/AQzbghWIXnE.jpg',
          cover: 'https://lh3.googleusercontent.com/AO19I73Kpi-8whXtmhfy1jw99ld8KgYXjyot2mS_OOV3MXKnUcC5vyTQoTRHDclX_7eU=h900',
          questions: 12,
          answers: 35,
          subscribers: 4
        },
        questions: [{
          title: 'How can we make Tye angry?',
          themes: ['Education', 'Lifehacks', 'Why did I ask it?'],
          answer: `Nunc nec nisi lorem. In id blandit erat. Ut molestie mollis lectus, et faucibus nisl tincidunt id. In orci diam, ultricies et fringilla eu, mattis et ex. In hac habitasse platea dictumst. Nam a ante vestibulum, tempus est a, vulputate purus. Vestibulum ornare diam in diam blandit pretium. Vestibulum accumsan nec nisl nec rhoncus. Cras tincidunt velit lacus, sit amet egestas odio consectetur eu. Morbi blandit ut ante sed aliquam.

Aenean id velit varius, fringilla justo sed, iaculis purus. Donec dictum tellus non venenatis pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus convallis faucibus dolor, eu congue risus finibus pretium. Nulla enim diam, consequat vel leo non, maximus sollicitudin ipsum. In urna dolor, aliquam quis tortor et, imperdiet lacinia dui. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris quis nibh elit. Aliquam erat.`
        }]
      }
    },

    computed: {
      coverStyle() {
        return 'background-image: url(' + this.user.cover + '); background-size: cover; background-position: center';
      }
    },

    filters: {
      cutAnswer(answer) {
        return answer.split(" ").slice(0, 20).join(" ") + " ..."; 
      }
    }
  }
</script>
