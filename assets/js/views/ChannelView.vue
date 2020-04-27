<template>
    <div>
        <h2>Channel View</h2>
        <GameView v-if="isConnected" :channel="channel"></GameView>
        <PasswordForm v-else-if="showPasswordForm" :channel="channel"></PasswordForm>
    </div>
</template>
    
<script>
import PasswordForm from '../components/PasswordForm';
import GameView from '../components/game-view/GameView';

export default {
    components: { PasswordForm, GameView },
    computed: {
        ...Vuex.mapGetters({
            channelById: 'channel/channelById'
        }),
        channel: function() {
            let channel = this.channelById(this.$route.params.id);
            return channel;
        },
        isConnected: function() {
            if(this.$store.getters['user/user'].username) return true;
            if(this.channel && this.channel.hasPassword == false) {
                this.$store.dispatch('channel/getChannel', this.channel)
                .then(() => {
                    return true;
                });  
            };
            
            return false;
        },
        showPasswordForm: function() {
            return this.channel != undefined && this.channel.hasPassword == true;
        }
    },
    mounted() {
        if(!this.channel) {
            this.$store.dispatch('channel/fetchChannels');
        }
    },
    beforeDestroy() {
        this.$store.commit('channel/eraseChannel');
        this.$store.commit('user/eraseUser');
    }
}
</script>

<style>

</style>