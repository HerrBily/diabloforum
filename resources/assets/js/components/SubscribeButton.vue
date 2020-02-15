<template>
    
    <button class="subscribe_btn" :class="classes" @click="subscribe">Subscribe</button>

</template>


<script>

    export default {

        props: ['active'],

        computed: {
            classes() {
                return ['subscribe_btn', this.active ? 'subscribe_btn_active' : 'btn-default'];
            }
        },


        methods: {
            subscribe() {

                axios[
                    (this.active ? 'delete' : 'post')
                    ](location.pathname + '/subscriptions');

                this.active = ! this.active;

            }
        }
    }

</script>