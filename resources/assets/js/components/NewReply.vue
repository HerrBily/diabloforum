<template>
<div>
  <div v-if="signedIn">
      <div class="form-group">
        <textarea name="body" 
                id="body" 
                class="form-control" 
                rows="5"
                required
                v-model="body"></textarea>
      </div>

        <button type="submit"
                class="btn btn-default"
                @click="addReply">Post</button>
  </div>

  <p class="text-center" v-else>
      Bitte <a href="/login">melde dich an</a> wenn du kommentieren willst.
  </p>

</div>
</template>


<script>
export default {

    props: ['endpoint'],

    data() {
        return {
            body: '',
        }
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        }
    },

    methods: {
        addReply() {
            axios.post(this.endpoint, { body: this.body })

                .catch(error => {
                    flash(error.response.data, 'danger');
                })

                .then(({data})   => {
                    this.body = '';

                    flash('Du hast kommentiert')

                    this.$emit('created', data);
                });
        }
    }

};
</script>