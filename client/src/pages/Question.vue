<template>
  <v-layout column>
    <div :style="`background: linear-gradient(#00000044, #00000044), url(${cover}); background-size: cover;`">
      <v-container>
        <v-layout column my-5>
          <router-link class="subheading white--text" :to="`/users/${question.author_id}`">
            {{ question.author.name }} {{ question.author.surname }} {{ question.created_at | readable }}
          </router-link>
          <h1 class="white--text" style="min-height: 150px">{{ question.text }}</h1>
          <v-layout row>
            <v-chip small outline color="white" v-for="theme in question.themes" :key="theme.id">{{ theme.name }}</v-chip>
          </v-layout>
        </v-layout>
        <v-flex xs12 style="margin-bottom: -50px">
          <v-card>
            <v-toolbar card>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly">
                <v-icon :left="$vuetify.breakpoint.smAndUp">mdi-comment-plus-outline</v-icon>
                <span v-if="$vuetify.breakpoint.smAndUp">Ответить</span>
              </v-btn>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly" @click="upvote">
                <v-badge color="primary">
                  <span slot="badge" dark small v-text="question.rating"></span>
                  <v-icon :left="$vuetify.breakpoint.smAndUp">mdi-heart-outline</v-icon>
                  <span v-if="$vuetify.breakpoint.smAndUp">Нравится</span>
                </v-badge>
              </v-btn>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly" :to="`/questions/${id}/comments`">
                <v-icon :left="$vuetify.breakpoint.smAndUp">mdi-comment-text-multiple-outline</v-icon>
                <span v-if="$vuetify.breakpoint.smAndUp">Комментировать</span>
              </v-btn>
              <v-btn flat :icon="$vuetify.breakpoint.xsOnly">
                <v-icon :left="$vuetify.breakpoint.smAndUp">mdi-bell-ring-outline</v-icon>
                <span v-if="$vuetify.breakpoint.smAndUp">Подписаться</span>
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
              <span class="title">{{ question.answers.length }} ответ(а/ов)</span>
            </v-flex>
            <v-flex xs12 v-for="answer in question.answers" :key="answer.id">
              <AnswerCard :answer="answer"></AnswerCard>
            </v-flex>
          </v-layout>
          <v-card>
            <v-card-text>
              <v-form v-model="valid" lazy-validation ref="answerForm">
                <v-text-field
                  label="Что Вы думаете по этому поводу?"
                  :placeholder="question.title"
                  v-model="answer"
                  :rules="answerRules"
                  :counter="140"
                  multi-line
                  rows="7"
                ></v-text-field>
                <v-btn @click="submit" :disabled="!valid" color="primary">
                  Ответить
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
  import AnswerCard from '../components/AnswerCard.vue';
  export default {
    props: ['id'],
    store: ['fallback'],
    components: {AnswerCard},

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
      this.updateQuestion();
    },

    methods: {
      updateQuestion() {
        window.axios.get('/api/questions/' + this.id)
                  .then(response => this.question = response.data)
                  .catch(error => {
                    console.log(error);
                    if (error.response.status == 404) {
                      this.$router.push('/404');
                    }
                    else {
                      this.snackbar.text = error.message;
                      this.snackbar.color = 'error';
                      this.snackbar.visible = true;
                    }
                  });
      },
      submit() {
        window.axios.post(`/api/questions/${this.id}/answers`, {text: this.answer})
                    .then(response => {
                      this.snackbar.text = 'Ответ успешно опубликован!';
                      this.snackbar.color = 'success';
                      this.snackbar.visible = true;
                      this.updateQuestion();
                    })
                    .catch(error => {
                      console.log(error);
                      this.snackbar.text = error.message;
                      this.snackbar.color = 'error';
                      this.snackbar.visible = true;
                    });
      },

      vote(status) {
        window.axios.post(`/api/questions/${this.id}/votes/${status}`)
                    .then(response => {
                      this.snackbar.text = 'Успешно!';
                      this.snackbar.color = 'success';
                      this.snackbar.visible = true;
                      this.updateQuestion();
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
      cover() {
        return this.question.cover === '' ? this.fallback.cover : this.question.cover;
      }
    },

    filters: {
      readable(date) {
        if (date === null) return 'когда-то';
        return window.moment(date).fromNow();
      }
    }
  }
</script>
