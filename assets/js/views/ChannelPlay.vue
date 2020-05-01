<template>
    <div>
        <h2>Channel Play</h2>
        <Command v-if="isConnected" :channel="channel" :user="user"></Command>
        <UserForm v-else-if="channel" :channel="channel"></UserForm>
    </div>
</template>
    
<script>
import UserForm from '../components/UserForm';
import Command from '../components/command/Command';

export default {
    components: { UserForm, Command },
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
            return this.$store.getters['channel/channel'];
        },
        isConnected: function() {
            if(this.$store.getters['user/user'].username) return true;
            
            return false;
        }
    },
    created() {
        if(this.channel.name == undefined) {
            this.$router.push({ name: 'home'});
        }
        window.addEventListener('beforeunload', this.removeUser);
    },
    beforeDestroy() {
        // add the same process for closing window/tab in created lifecycle
        this.removeUser();
        this.$store.commit('channel/eraseChannel');
    },
    methods: {
        removeUser() {
            if(this.user.token) {
                this.$store.dispatch('user/disconnectUser', {channel: this.channel, token: this.user.token});
            }
        }
    }
}
</script>

<style>

</style>