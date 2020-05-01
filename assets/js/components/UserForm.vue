<template>
    <form @submit="checkForm" method="post" novalidate="true">
        <h2>Rejoindre la partie {{ channel.name }}</h2>
        <p v-if="errors.length" class="text-danger">
            <b>Veuillez corriger ces erreurs :</b>
            <ul>
                <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
            </ul>
        </p>

        <div v-if="hasPassword" class="form-group row">
            <label for="name" class="col-sm-3 col-form-label font-weight-bold">Mot de passe</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="password" v-model="password" :disabled="disabled == 1">
            </div>
        </div>
        <hr v-if="hasPassword">
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label font-weight-bold">Nom de joueur</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="name" v-model="username" :disabled="disabled == 1">
            </div>
        </div>

        <button class="mt-4 btn btn-lg btn-primary" :disabled="disabled == 1">Valider</button>
    </form>    
</template>

<script>
import checkUserForm from '../form/checkUserForm';
//TODO check if username already used in the party
export default {
    data() {
        return {
            username: '',
            password: '',
            disabled: 0,
            errors: []
        };
    },
    props: {
        channel: Object
    },
    computed: {
        hasPassword: function() {
            return this.channel.hasPassword;
        }
    },
    methods: {
        checkForm: function(e) {
            e.preventDefault();
            this.errors = checkUserForm(this.username, this.hasPassword, this.password);

            if(!this.errors.length) {
                this.disabled = 1;
                this.$store.dispatch('channel/addUser', { channel: this.channel, username: this.username, password: this.password })
                .then(data => {
                    console.log('inside UserForm', data);
                    if(data.channel.id && data.user.username) {
                        this.$store.commit('message/setMessage', { type: 'success', text: 'Connexion à la partie ' + this.channel.name + ' réussie' });
                    }
                    this.disabled = 0;
                })                
                .catch(error => {
                    console.log('promise error inside userForm', error.response.data);
                    if (error.response.data.error) {
                        this.$store.commit('message/setMessage', { type: 'danger', text: error.response.data.error });
                    } else {
                        this.$store.commit('message/setMessage', { type: 'danger', text: 'Erreur inconnue' });
                    }
                    this.disabled = 0;
                });
            }
        } 
    }
}
</script>

<style>

</style>