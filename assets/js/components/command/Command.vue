<template>
    <div>
        <h2 class="h2">{{ channel.name }}</h2>
        <div>Joueur : {{ user.username }}</div>
        <div>IsPlaying : {{ isPlaying }}</div>
        <div v-if="stage == 'waiting'">
            <div>En attendre d'autres joueurs</div>
            <div>
                <button :disabled="disabled == 1" class="btn btn-primary" v-on:click="onReady">Prêt</button>
            </div>
        </div>
        <CommandSelectGame v-bind="props" :isPlaying="isPlaying" v-if="stage == 'selecting'"></CommandSelectGame>
        <CommandPlay :channel="channel" :isPlaying="isPlaying" v-if="stage == 'playing'"></CommandPlay>
        <CommandScore :channel="channel" :isPlaying="isPlaying" v-if="stage == 'rating'"></CommandScore>
    </div>
</template>

<script>
import CommandPlay from './CommandPlay';
import CommandScore from './CommandScore';
import CommandSelectGame from './CommandSelectGame';
import { readyToPlay } from '../../service/CommandService';

export default {
    components: { CommandPlay, CommandScore, CommandSelectGame },
    props: {
        channel: Object,
        user: Object
    },
    data() {
        return {
            disabled: 0,
        };
    },
    computed: {
        isPlaying: function() {
            console.log('isPlaying', this.user.username);
            console.log('isPlaying', this.channel.storyteller && this.channel.storyteller.username);
            console.log('isPlaying', this.channel.storyteller && this.channel.storyteller.username == this.user.username);

            return this.channel.storyteller && this.channel.storyteller.username == this.user.username;
        },
        stage: function() {
            console.log('on test si c this.props ou this.', this.user, this.channel);
            return this.channel.game && this.channel.game.stage;
        }
    },
    methods: {
        onReady() {
            this.disabled = 1;

            readyToPlay({channel: this.channel, token: this.user.token}).then(data => {
                console.log('setUser');
                this.$store.commit('user/setUser', data.user);
                console.log('setChannel');
                this.$store.commit('user/setChannel', data.channel);
            }).catch(data => {
                this.disabled = 0;
                this.className = 'btn-primary';
            });
        }
    }
}
</script>

<style>

</style>