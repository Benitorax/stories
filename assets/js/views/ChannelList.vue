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
                    <td>{{ channel.users|count }}</td>
                    <td>
                        <ButtonLink routeName="channel-view" buttonClass="btn-primary" buttonText="Play"></ButtonLink>
                        <ButtonLink routeName="channel-connect" buttonClass="btn-primary" buttonText="Watch"></ButtonLink>
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
        count: function(array) {
            return array.length;
        },
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
    beforeCreate() {
        this.$store.dispatch('channel/fetchChannels');
    }

}
</script>

<style>

</style>