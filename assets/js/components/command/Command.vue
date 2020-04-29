<template>
    <div>
        <div>{{ user.username }}</div>
        <div v-if="channel.stage == 'waiting'"></div>
        <CommandSelectGame :isPlaying="isPlaying" v-if="channel.stage == 'selecting'"></CommandSelectGame>
        <CommandPlay :isPlaying="isPlaying" v-if="channel.stage == 'playing'"></CommandPlay>
        <CommandScore :isPlaying="isPlaying" v-if="channel.stage == 'rating'"></CommandScore>
    </div>
</template>

<script>
import CommandPlay from './CommandPlay';
import CommandScore from './CommandScore';
import CommandSelectGame from './CommandSelectGame';

export default {
    components: { CommandPlay, CommandScore, CommandSelectGame },
    props: {
        channel: Object,
        User: Object
    },
    computed: {
        isPlaying() {
            return this.channel.storyteller.username == this.user.username;
        }
    }
}
</script>

<style>

</style>