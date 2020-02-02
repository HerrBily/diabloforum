<script>
    import Replies from '../components/Replies.vue';

    export default {
        props: ['initRepliesCount'],

        components: { Replies },

        data() {
            return {
                repliesCount: this.initRepliesCount
            };
        }

    };
</script>