<template>
  <v-layout column>
    <div :style="coverStyle">
      <v-container>
        <v-layout column justify-end style="min-height: 500px">
          <v-flex xs12>
            <v-layout row align-end>
              <v-avatar size="200px" style="margin-bottom: -90px">
                <img src="public/avatars/avatar-05.png" style="background-color: white">
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
        </v-layout>
      </v-container>
    </div>
    <v-container grid-list-xl>
      <v-layout row>
        <v-flex xs8>
          <v-layout column>
            <v-flex xs12>
              <v-card>
                <v-toolbar card>
                  <v-btn flat>
                    <v-icon>mdi-comment-plus-outline</v-icon>
                    <span>&nbsp;Answer</span>
                  </v-btn>
                  <v-btn flat>
                    <v-icon>mdi-heart-outline</v-icon>
                    <span>&nbsp;Like</span>
                  </v-btn>
                  <v-btn flat>
                    <v-icon>mdi-comment-text-multiple-outline</v-icon>
                    <span>&nbsp;Comment</span>
                  </v-btn>
                  <v-btn flat>
                    <v-icon>mdi-bell-ring-outline</v-icon>
                    <span>&nbsp;Subscribe</span>
                  </v-btn>
                </v-toolbar>
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
        user: {
          name: 'John Doe',
          about: 'Vestibulum sem metus, tempus vel nisl nec, tristique dapibus enim. Maecenas aliquet nisl vel ante dapibus convallis. Vestibulum maximus ligula nec odio laoreet, nec hendrerit ipsum dictum. Donec ut augue vestibulum diam blandit aliquet. Nullam ipsum sem, tempus id rhoncus ac, vestibulum et urna. Proin id lorem ullamcorper, consectetur dolor ac, luctus dolor. Mauris ipsum ipsum, sodales sollicitudin vestibulum tristique, semper at urna. Mauris vitae risus ex. Pellentesque nibh purus, imperdiet nec ullamcorper quis, sodales a dui. Etiam interdum pulvinar sapien, vitae scelerisque ex. Mauris finibus, eros in bibendum egestas, neque nulla malesuada ante, at ullamcorper tellus ligula vitae orci. Fusce sed rhoncus lacus. Quisque id ex vulputate, hendrerit erat et, cursus arcu. Maecenas molestie aliquet sapien in sagittis. Donec auctor suscipit metus vitae euismod. Aenean eu elit neque.',
          rating: 265,
          avatar: 'public/avatars/avatar-01.png',
          cover: 'https://lh3.googleusercontent.com/AO19I73Kpi-8whXtmhfy1jw99ld8KgYXjyot2mS_OOV3MXKnUcC5vyTQoTRHDclX_7eU=h900'
        }
      }
    },

    computed: {
      coverStyle() {
        return 'background-image: url(' + this.user.cover + '); background-size: cover; background-position: center';
      }
    }
  }
</script>
