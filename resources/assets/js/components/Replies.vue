<template>
    <div>
        <new-reply :endpoint="endpoint" @created="add"></new-reply>    
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>

        <!-- <new-reply :endpoint="endpoint" @created="add"></new-reply> -->
    </div>
</template>

<script>

    import Reply from './Reply.vue';
     import NewReply from './NewReply.vue';


    export default {
       props: ['data'],

        components: { Reply, NewReply },

        data() {
            return {
                // dataSet: false,
                items: this.data,
                endpoint: location.pathname + '/replies'
            }
        },

        // created() {
        //     this.fetch();
        // },

        methods: {
            // fetch() {
            //     axios.get(this.url)
            //         .then(this.refresh);
            // },

            // url() {
            //     return `${location.pathname}/replies`;
            // },

            // refresh(data) {
            //     this.dataSet = data;
            //     this.items = data.data;
            // },

            add(reply) {
                this.items.push(reply);

                this.$emit('added');
            },

            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed');

                flash('Kommentar wurde gelöscht!');
            }
        }

    }
</script>