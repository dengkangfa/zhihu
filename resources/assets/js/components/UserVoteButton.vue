<template lang="html">
    <button
        class="btn btn-default"
        :class="{'btn-primary': voted}"
        v-text="text"
        @click="vote"
    ></button>
</template>

<script>
  export default {
      props: ['answer', 'count'],
      mounted() {
          this.votes = this.count;
         //判断用户是否已点赞
        axios.post('/api/answer/' + this.answer + '/votes/users').then(response => {
            this.voted= response.data.voted;
        })
      },
      data() {
          return {
              voted: false,
              votes: 0
          }
      },
      computed: {
          text() {
              return this.votes;
          }
      },
      methods: {
          vote() {
              axios.post('/api/answer/vote',{'answer': this.answer}).then(response => {
                  this.voted= response.data.voted;
                  response.data.voted ? this.votes ++ : this.votes --;
              })
          }
      }
  }
</script>
