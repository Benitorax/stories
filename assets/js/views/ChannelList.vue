<template>
    <div>
        <h2>Liste des parties</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Mot de passe</th>
                    <th scope="col">Joueurs</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="channel in channels" :key="channel.id">
                    <td>{{ channel.name }}</td>
                    <td>{{ channel.hasPassword|translateBoolean }}</td>
                    <td>{{ channel.usersCount }}/{{ channel.usersMax }}</td>
                    <td>
                        <!-- <ButtonLink v-on:click="onClickPlay(channel.id)" routeName="channel-play" :routeParams="{ id: channel.id }" buttonClass="btn-primary" buttonText="Play"></ButtonLink>
                        <ButtonLink routeName="channel-view" :routeParams="{ id: channel.id }" buttonClass="btn-primary" buttonText="Watch"></ButtonLink> -->
                        <a routeName="channel-play" :routeParams="{ id: channel.id }"><button v-on:click="onClickPlay(channel.id)" class="btn btn-primary">Jouer</button></a>
                        <a routeName="channel-view" :routeParams="{ id: channel.id }"><button v-on:click="onClickView(channel.id)" class="btn btn-primary">Regarder</button></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
    
<script>
import ButtonLink from '../components/ButtonLink';

export default {
    components: { ButtonLink },
    computed: {
        channels: function() {
            return this.$store.getters['channel/channels'];
        } 
    },
    filters: {
        translateBoolean: function(bool) {
            if(bool == false) return 'Non';
            else if(bool == true) return 'Oui';
            else return '';
        },
        capitalize: function (value) {
            if (!value) return '';
            value = value.toString();
            return value.charAt(0).toUpperCase() + value.slice(1);
        }
    },
    methods: {
        onClickPlay(id) {
            let channel = this.channels.find(channel => { return channel.id == id });
            this.$store.commit('channel/setChannel', channel);
            this.$router.push({ name: 'channel-play', params: {id: channel.id} });
        },
        onClickView(id) {
            let channel = this.channels.find(channel => { return channel.id == id });
            this.$store.commit('channel/setChannel', channel);
            this.$router.push({ name: 'channel-view', params: {id: channel.id} });
        }
    },
    beforeCreate() {
        this.$store.dispatch('channel/fetchChannels');
    }

}
</script>

<style>

</style>