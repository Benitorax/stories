<template>
    <form @submit="checkForm" method="post" novalidate="true">
        <p v-if="errors.length" class="text-danger">
            <b>Veuillez corriger ces erreurs :</b>
            <ul>
                <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </p>

        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label font-weight-bold">Nom</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="name" v-model="channel.name">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label font-weight-bold">Nombre de joueurs maximum</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="name" v-model="channel.usersMax" min="2" max="11">
            </div>
        </div>

        <fieldset class="form-group mt-4">
            <div class="row">
                <legend class="col-sm-3 col-form-label font-weight-bold">Mot de passe</legend>
                <div class="col-sm-9 pt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="true" value="1" v-model="channel.hasPassword" checked>
                        <label class="form-check-label" for="true">oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="false" value="0" v-model="channel.hasPassword">
                        <label class="form-check-label" for="false">non</label>
                    </div>
                    <div class="mt-3">
                        <input type="password" class="form-control" id="password" v-model="channel.password" :disabled="channel.hasPassword != 1">
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group mt-4">
            <div class="row">
                <legend class="col-sm-3 col-form-label font-weight-bold">Visibilité</legend>
                <div class="col-sm-9 pt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="public" value="1" v-model="channel.isPublic" checked>
                        <label class="form-check-label" for="public">Public</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="private" value="0" v-model="channel.isPublic">
                        <label class="form-check-label" for="private">Privé</label>
                    </div>
                </div>
            </div>
        </fieldset>
        <hr class="mt-4">
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label font-weight-bold">Nom de joueur</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="name" v-model="channel.username">
            </div>
        </div>
        <button class="mt-4 btn btn-lg btn-primary" :disabled="disabled == 1">Valider</button>
    </form>
</template>

<script>
import checkChannelForm from '../form/checkChannelForm';

export default {
    data() {
        return {
            channel: {
                name: '',
                usersMax: 10,
                hasPassword: 1,
                password: '',
                isPublic: 1,
                username: ''
            },
            errors: [],
            disabled: 0
        };
    }, computed: {
    
    },
    methods: {
        checkForm: function(e) {
            e.preventDefault();
            this.errors = checkChannelForm(this.channel);

            if(!this.errors.length) {
                this.disabled = 1;
                this.$store.dispatch('channel/create', this.channel)
                .then((data) => {
                    console.log('inside ChannelForm', data);
                    if(data.channel.id && data.user.username) {
                        this.$store.commit('message/setMessage', { type: 'success', text: 'Partie créée, connectez-vous à cette partie depuis un écran partagé.' });
                        this.$router.push({ name: 'channel-play', params: {id: data.channel.id} });
                    }
                
                    this.disabled = 0;
                })                
                .catch((data) => {
                    console.log('promise error inside channelForm', data);
                    this.$store.commit('message/setMessage', { type: 'danger', text: 'Server problem. Please, retry later.' });
                    this.disabled = 0;
                });
            };
        } 
    }
}
</script>

<style>

</style>