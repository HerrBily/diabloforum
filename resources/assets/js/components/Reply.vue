<template>
  <div :id="'reply-'+id" class="panel panel-default replies_background">
    <div class="panel-heading">
      <div class="replies_cnt">
        <div class="replies_items">
          <h5>
            <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a>
          </h5>
          <p v-text="ago"></p>
        </div>
        <div class="favorite_btn" v-if="signedIn">
            <favorite :reply="data"></favorite>
        </div>
      </div>
      <div class="panel-body">
        <div v-if="editing">
          <form @submit="update">
            <div class="form-group">
              <textarea class="form-control" v-model="body" required></textarea>
            </div>
            
            <button class="btn btn-xs btn-primary">Update</button>
            <button class="btn btn-xs btn-link" @click="editing = false" type="button">Abbruch</button>
          </form>
        </div>

        <p v-else v-text="body"></p>
    </div>

    </div>

    
    <div class="panel-footer" v-if="canUpdate">
      <button class="btn" @click="editing= true ">Bearbeiten</button>
      <button class="reply_delete_btn" @click="destroy">Löschen</button>
    </div>
     
  </div>
</template>



<script>
import Favorite from "./Favorite.vue";
import moment from 'moment';

export default {
  props: ["data"],
  

  components: { Favorite },

  data() {
    return {
      editing: false,
      id: this.data.id,
      body: this.data.body,
    };
  },


  computed: {

      ago() {
        return this.data.created_at;
      },

      signedIn() {
          return window.App.signedIn;
      },

      canUpdate() {

        return this.authorize(user => this.data.user_id == user.id);
          
      }
  },

  methods: {
    update() {
      axios.patch(

        "/replies/" + this.data.id, {
        body: this.body

      })

      .catch(error => {

        flash(error.response.data, 'danger');

      })

      this.editing = false;

      flash("Bearbeitet!");
    },

    destroy() {
      axios.delete("/replies/" + this.data.id);

      this.$emit("deleted", this.data.id);
    }
  }
};
</script>