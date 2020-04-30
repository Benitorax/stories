<template>
    <div>
        <div v-if="isPlaying">
            <button :disabled="disabled == 1" class="btn btn-primary" v-on="onRollNormalDice">Lancer dé</button>
            <button :disabled="disabled == 1" class="btn btn-primary" v-on="onRollWhiteDice">Lancer dé blanc</button>
        </div>
        <div v-else>
            <button :disabled="disabled == 1" class="btn btn-primary" v-on="onRollBlackDice">Lancé dé noir</button>
        </div>
    </div>
</template>

<script>
import { rollNormalDice, rollWhiteDice, rollBlackDice } from '../../service/CommandService';

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
        onRollNormalDice: function() {
            rollNormalDice(this.data).then(data => {
                this.$store.commit('user/setUser', data.user);
                this.$store.commit('user/setChannel', data.channel);
            }).catch(data => {
                console.log('error in CommandPlay', data);
                this.$store.commit('message/setMessage', { type: 'danger', text: 'server problem' });
            });
        },
        onRollWhiteDice: function() {
            rollWhiteDice(this.data).then(data => {
                this.$store.commit('user/setUser', data.user);
                this.$store.commit('user/setChannel', data.channel);
            }).catch(data => {
                console.log('error in CommandPlay', data);
                this.$store.commit('message/setMessage', { type: 'danger', text: 'server problem' });
            });
        },
        onRollBlackDice: function() {
            rollBlackDice(this.data).then(data => {
                this.$store.commit('user/setUser', data.user);
                this.$store.commit('user/setChannel', data.channel);
            }).catch(data => {
                console.log('error in CommandPlay', data);
                this.$store.commit('message/setMessage', { type: 'danger', text: 'server problem' });
            });
        }
    }
}
</script>

<style>

</style>