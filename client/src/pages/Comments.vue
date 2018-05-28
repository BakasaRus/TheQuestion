<template>
  <v-container grid-list-xl mt-5>
    <v-layout row>
      <v-flex xs12 lg8>
        <v-btn :to="`/${this.type}/${this.id}`" color="secondary">
          <v-icon left>mdi-arrow-left</v-icon>
          Вернуться к источнику
        </v-btn>
        <v-layout column my-3>
          <v-flex xs12 v-for="comment in comments" :key="comment.id">
            <CommentCard :comment="comment"></CommentCard>
          </v-flex>
        </v-layout>
        <v-card>
          <v-card-text>
            <v-form v-model="valid" lazy-validation ref="commentForm">
              <v-text-field
                label="Выскажите своё важное (нет) мнение"
                v-model="comment"
                :rules="commentRules"
                multi-line
                rows="7"
              ></v-text-field>
              <v-btn @click="submit" :disabled="!valid" color="primary">
                Отправить
              </v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12 lg4>
        <h1>Nice ads here</h1>
      </v-flex>
    </v-layout>
    <v-snackbar :color="snackbar.color" right v-model="snackbar.visible">
      {{ snackbar.text }}
      <v-btn dark flat @click.native="snackbar.visible = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
  import CommentCard from '../components/CommentCard.vue';
  export default {
    props: ['id', 'type'],
    components: {CommentCard},
    data: () => ({
      comments: {},
      valid: false,
      comment: '',
      commentRules: [
        v => !!v || 'Нужно написать комментарий'
      ],
      snackbar: {
        visible: false,
        text: '',
        color: 'success'
      },
    }),

    created() {
      this.updateComments();
    },

    methods: {
      updateComments() {
        window.axios.get(`/api/${this.type}/${this.id}/comments`)
                    .then(response => this.comments = response.data)
                    .catch(error => {
                      console.log(error);
                      this.snackbar.text = error.message;
                      this.snackbar.color = 'error';
                      this.snackbar.visible = true;
                    });
      },

      submit() {
        window.axios.post(`/api/${this.type}/${this.id}/comments`, {text: this.comment})
                    .then(response => {
                      this.snackbar.text = 'Комментарий успешно опубликован!';
                      this.snackbar.color = 'success';
                      this.snackbar.visible = true;
                      this.updateComments();
                      this.$refs.commentForm.reset();
                    })
                    .catch(error => {
                      console.log(error);
                      this.snackbar.text = error.message;
                      this.snackbar.color = 'error';
                      this.snackbar.visible = true;
                    });
      }
    }
  }
</script>