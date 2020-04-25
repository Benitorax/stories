<template>
    <div>
        <h2>Channel Play</h2>
        <div>Partie: {{ channel.name }}</div>
        <div>Joueur: {{ user.username }}</div>
        <Command></Command>
    </div>
</template>
    
<script>
import Command from '../components/Command';

export default {
    components: { Command },
    data() {
        return {
            channel: this.$store.getters['channel/channel'],
            user: this.$store.getters['user/user']
        };
    }
    
}
</script>

<style>

</style>