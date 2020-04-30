<template>
    <div>
        <h2 class="h2">{{ channel.name }}</h2>
        <div>{{ user.username }}</div>
        <div v-if="channel.stage == 'waiting'">
            <div>En attendre d'autres joueurs</div>
            <div>
                <button :disabled="disabled == 1" class="btn btn-primary" v-on="onReady()">Prêt</button>
            </div>
        </div>
        <CommandSelectGame :props="props" :isPlaying="isPlaying" v-if="channel.stage == 'selecting'"></CommandSelectGame>
        <CommandPlay :channel="channel" :token="token" :isPlaying="isPlaying" v-if="channel.stage == 'playing'"></CommandPlay>
        <CommandScore :channel="channel" :token="token" :isPlaying="isPlaying" v-if="channel.stage == 'rating'"></CommandScore>
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
        isPlaying() {
            return this.channel.storyteller.username == this.user.username;
        },
        token() {
            return user.token;
        }
    },
    methods: {
        onReady() {
            this.disabled = 1;

            readyToPlay({token: this.token}).then(data => {
                this.$store.commit('user/setUser', data.user);
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