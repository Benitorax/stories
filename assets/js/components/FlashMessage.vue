<template>
    <div class="alert" :class="'alert-' + message.type" role="alert">
        <div class="row align-items-end">
            <div class="col-11 justify-content-center">
                {{ message.text }}
            </div>
            <div class="ml-auto col-1">
                <button type="button" @click="onClick" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        message: function() {
            return this.$store.getters['message/message'];
        }
    },
    methods: {
        onClick: function() {
            this.$store.commit('message/eraseMessage')
        }
    },
    mounted: function() {
        setTimeout(() => this.onClick(), 5000); 
    }


}
</script>

<style>

</style>