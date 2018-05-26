<template>
  <v-layout column>
    <div style="background-image: url(http://getwallpapers.com/wallpaper/full/a/3/b/430317.jpg); background-size: cover;">
      <v-container>
        <v-layout column my-5>
          <span class="subheading white--text">{{ question.author.name }} {{ question.author.surname }} on {{ question.created_at }}</span>
          <h1 class="white--text" style="min-height: 150px">{{ question.text }}</h1>
          <v-layout row>
            <v-chip small outline color="white" v-for="theme in question.themes" :key="theme.id">{{ theme.name }}</v-chip>
          </v-layout>
        </v-layout>
        <v-flex xs12 style="margin-bottom: -50px">
          <v-card>
            <v-toolbar card>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly">
                <v-icon>mdi-comment-plus-outline</v-icon>
                <span v-if="$vuetify.breakpoint.smAndUp">&nbsp;Answer</span>
              </v-btn>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly">
                <v-icon>mdi-heart-outline</v-icon>
                <span v-if="$vuetify.breakpoint.smAndUp">&nbsp;Like</span>
              </v-btn>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly">
                <v-icon>mdi-comment-text-multiple-outline</v-icon>
                <span v-if="$vuetify.breakpoint.smAndUp">&nbsp;Comment</span>
              </v-btn>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly">
                <v-icon>mdi-bell-ring-outline</v-icon>
                <span v-if="$vuetify.breakpoint.smAndUp">&nbsp;Subscribe</span>
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
                    <v-list-tile-title>Close answers</v-list-tile-title>
                  </v-list-tile>
                  <v-list-tile @click="">
                    <v-list-tile-title>Delete</v-list-tile-title>
                  </v-list-tile>
                </v-list>
              </v-menu>
            </v-toolbar>
          </v-card>
        </v-flex>
      </v-container>
    </div>
    <v-container grid-list-xl mt-5>
      <v-layout row wrap>
        <v-flex xs12 lg8>
          <v-layout column>
            <v-flex xs12>
              <span class="title">{{ question.answers.length }} answers</span>
            </v-flex>
            <v-flex xs12 v-for="answer in question.answers" :key="answer.id">
              <v-card>
                <v-card-title>
                  <v-layout row>
                    <v-flex>
                      <v-avatar size="50px">
                        <img :src="answer.author.avatar" :alt="answer.author.name">
                      </v-avatar>
                    </v-flex>
                    <v-flex xs12>
                      <span class="body-2">{{ answer.author.name }} {{ answer.author.surname }}</span>&nbsp;
                      <span class="body-1">
                        <v-icon color="green">mdi-star-outline</v-icon>
                        <span>{{ answer.author.rating }}</span>
                      </span>&nbsp;
                      <span class="body-1">{{ answer.created_at }}</span><br>
                      <span class="body-1">{{ answer.author.about }}</span>
                    </v-flex>
                  </v-layout>
                </v-card-title>
                <v-card-text>{{ answer.text }}</v-card-text>
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
          <v-card>
            <v-card-text>
              <v-form v-model="valid" lazy-validation ref="answerForm">
                <v-text-field
                  label="Answer"
                  :placeholder="question.title"
                  v-model="answer"
                  :rules="answerRules"
                  :counter="140"
                  multi-line
                  rows="7"
                ></v-text-field>
                <v-btn @click="submit" :disabled="!valid">
                  Submit
                </v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 lg4>
          <h1>Nice ads here</h1>
        </v-flex>
      </v-layout>
    </v-container>
    <v-snackbar :color="snackbar.color" right v-model="snackbar.visible">
      {{ snackbar.text }}
      <v-btn dark flat @click.native="snackbar.visible = false">Close</v-btn>
    </v-snackbar>
  </v-layout>
</template>

<script>
  export default {
    props: ['id'],
    store: ['fallback'],

    data () {
      return {
        question: {},
        valid: false,
        snackbar: {
          visible: false,
          text: '',
          color: 'success'
        },
        answer: '',
        answerRules: [
          v => !!v || 'Нужно написать ответ на вопрос',
          v => v.length >= 140 || 'Ответ должен быть длиной в 140 символов'
        ]
      }
    },

    created() {
      window.axios.get('/api/questions/' + this.id)
                  .then(response => this.question = response.data)
                  .catch(error => console.log(error));
    },

    methods: {
      submit() {
        window.axios.post(`/api/questions/${this.id}/answers`, {text: this.answer})
                    .then(response => {
                      this.snackbar.text = 'Ответ успешно опубликован!';
                      this.snackbar.color = 'success';
                      this.snackbar.visible = true;
                      this.created();
                      this.$refs.answerForm.reset();
                    })
                    .catch(error => {
                      console.log(error);
                      this.snackbar.text = error.message;
                      this.snackbar.color = 'error';
                      this.snackbar.visible = true;
                    });
      }
    },

    computed: {
      avatar() {
        return this.user.avatar === '' ? this.store.fallback.avatar : this.user.avatar;
      }
    }
  }
</script>
