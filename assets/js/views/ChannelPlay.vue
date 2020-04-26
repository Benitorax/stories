<template>
    <div>
        <h2>Channel Play</h2>
        <Game v-if="isConnected" :channel="channel" :user="user"></Game>
        <UserForm v-else-if="channel" :channel="channel"></UserForm>
    </div>
</template>
    
<script>
import UserForm from '../components/UserForm';
import Game from '../components/Game';

export default {
    components: { UserForm, Game },
    data() {
        return {
            
        };
    },
    computed: {
        ...Vuex.mapGetters({
            channelById: 'channel/channelById'
        }),
        user: function() {
            return this.$store.getters['user/user'];
        },
        channel: function() {
            let channel = this.channelById(this.$route.params.id);
            return channel;
        },
        isConnected: function() {
            if(this.$store.getters['user/user'].username) return true;
            
            return false;
        }
    },
    mounted() {
        if(!this.channel) {
            this.$store.dispatch('channel/fetchChannels');
        }
    },
    beforeDestroy() {
        this.$store.commit('user/eraseUser');
        this.$store.commit('channel/eraseChannel');
    }
}
</script>

<style>

</style>