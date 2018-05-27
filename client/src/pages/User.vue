<template>
  <v-layout column>
    <v-flex xs12 :style="`background-image: url(${cover}); background-size: cover; background-position: center`">
      <v-container>
        <v-layout column justify-end style="min-height: 300px;">
          <v-flex xs12>
            <v-layout row align-end>
              <v-avatar size="200px" style="margin-bottom: -50px; z-index: 1">
                <img :src="avatar" style="background-color: white">
              </v-avatar>
              <v-layout column mx-5>
                <h1 class="display-2 white--text">
                  {{ user.name }} {{ user.surname }} 
                  <v-icon color="white" x-large v-if="user.is_banned">mdi-emoticon-dead</v-icon>
                </h1>
                <span class="subheading white--text">{{ user.about }}</span>
              </v-layout>
              <v-layout column ml-5 align-end>
                <span class="subheading white--text">Рейтинг</span>
                <span class="display-3 white--text">{{ user.rating }}</span>
              </v-layout>
            </v-layout>
          </v-flex>
          <v-flex xs12 mt-3 style="margin-bottom: -50px">
            <v-card>
              <v-toolbar card style="padding-left: 200px">
                <v-btn flat>
                  <v-badge color="primary">
                    <span slot="badge" dark small v-if="user.questions.length" v-text="user.questions.length"></span>
                    <v-icon>mdi-comment-question-outline</v-icon>
                    <span>&nbsp;Questions</span>
                  </v-badge>
                </v-btn>
                <v-btn flat>
                  <v-badge color="primary">
                    <span slot="badge" dark small v-if="user.answers.length" v-text="user.answers.length"></span>
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
                    <span slot="badge" dark small v-if="user.subscriptions.length" v-text="user.subscriptions.length"></span>
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
                    <v-list-tile @click="deactivate">
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
            <v-flex xs12 v-for="question in user.questions" :key="question.id">
              <QuestionCard :question="question"></QuestionCard>
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
  import QuestionCard from '../components/QuestionCard.vue';
  export default {
    components: {QuestionCard},
    props: ['id'],
    store: ['fallback'],
    data: () => ({
      user: {}
    }),

    created() {
      window.axios.get(`/api/users/${this.id}`)
                  .then(response => this.user = response.data)
                  .catch(error => {
                    console.log(error);
                    if (error.response.status == 404) {
                      this.$router.push('/404');
                    }
                  });
    },

    methods: {
      deactivate() {
        window.axios.patch(`/api/users/${this.id}/deactivate`)
                    .then(response => console.log(response))
                    .catch(error => console.log(error));
      }
    },

    computed: {
      cover() {
        return this.user.cover === '' ? this.fallback.cover : this.user.cover;
      },

      avatar() {
        return this.user.avatar === '' ? this.fallback.avatar : this.user.avatar;
      }
    }
  }
</script>
