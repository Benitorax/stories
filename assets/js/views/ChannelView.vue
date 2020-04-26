<template>
    <div>
        <h2>Channel View</h2>
        <div v-if="isConnected">
            <div>Partie: {{ channel.name }}</div>
        </div>
        <PasswordForm v-else-if="channel" :channel="channel"></PasswordForm>
    </div>
</template>
    
<script>
import PasswordForm from '../components/PasswordForm';

export default {
    components: { PasswordForm },
    data() {
        return {
        };
    },
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
            if(this.channel && this.channel.hasPassword == false) return true;
            
            return false;
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