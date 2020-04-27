<template>
    <div>
        <div v-if="channel.stage == 'waiting'"></div>
        <CommandSelectGame v-if="channel.stage == 'selecting'"></CommandSelectGame>
        <CommandPlay v-if="channel.stage == 'playing'"></CommandPlay>
        <CommandScore v-if="channel.stage == 'rating'"></CommandScore>
    </div>
</template>

<script>
import CommandPlay from './CommandPlay';
import CommandScore from './CommandScore';
import CommandSelectGame from './CommandSelectGame';

export default {
    components: { CommandPlay, CommandScore, CommandSelectGame },
    props: {
        channel: Object
    }
}
</script>

<style>

</style>