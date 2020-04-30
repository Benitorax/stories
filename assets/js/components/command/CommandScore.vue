<template>
    <div>
        <div v-if="isPlaying">
            <button :disabled="disabled == 1" class="btn btn-primary" v-on="onRollDiceForRating">Lancer dé</button>
        </div>
        <div v-else>
            <button :disabled="disabled == 1" class="btn btn-primary" v-on="onVoteForAllowingSecondRoll(true)">Oui</button>
            <button :disabled="disabled == 1" class="btn btn-primary" v-on="onVoteForAllowingSecondRoll(false)">Non</button>
        </div>
    </div>
</template>

<script>
import { rollDiceForRating, voteForAllowingSecondRoll } from '../../service/CommandService';

export default {
    props: {
        isPlaying: Boolean,
        channel: Object,
        user: Object
    },
    data() {
        return {
            disabled: 0,
        };
    },
    computed: {
        data() {
            return {
                channel: this.channel,
                token: this.user.token
            };
        }
    },
    methods: {
        onRollDiceForRating: function() {
            rollDiceForRating(this.data).then(data => {
                this.$store.commit('user/setUser', data.user);
                this.$store.commit('user/setChannel', data.channel);
            }).catch(data => {
                console.log('error in CommandScore', data);
                this.$store.commit('message/setMessage', { type: 'danger', text: 'server problem' });
            });
        },
        onVoteForAllowingSecondRoll: function(vote) {
            voteForAllowingSecondRoll(
                Object.assign(this.data, {vote})
            ).then(data => {
                this.$store.commit('user/setUser', data.user);
                this.$store.commit('user/setChannel', data.channel);
            }).catch(data => {
                console.log('error in CommandScore', data);
                this.$store.commit('message/setMessage', { type: 'danger', text: 'server problem' });
            });
        },
    }

}
</script>

<style>

</style>