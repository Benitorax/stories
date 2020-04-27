<template>
    <div>
        <div>Partie: {{ channel.name }}</div>
        <Dashboard v-if="channel.stage == 'waiting'" :users="users"></Dashboard>
        <GameSelect v-if="channel.stage == 'selecting'"></GameSelect>
        <GamePlay v-if="channel.stage == 'playing'" :messages="messages"></GamePlay>
        <GameScore v-if="channel.stage == 'rating'"></GameScore>
    </div>
</template>

<script>
import GameSelect from './GameSelect';
import GameScore from './GameScore';
import GamePlay from './GamePlay';
import Dashboard from './Dashboard';

export default {
    components: { GameSelect, GameScore, GamePlay, Dashboard },
    props: {
        channel: Object,
        user: Object
    },
    computed: {
        users: function() {
            return this.channel.users;
        },
        showDashboard: function() {
            return !this.isPlaying;
        },
        messages: function() {
            return;
        }
    }
}
</script>

<style>

</style>