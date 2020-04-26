<template>
    <form @submit="checkForm" method="post" novalidate="true">
        <h2>Rejoindre la partie "{{ channel.name }}"</h2>
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
        <button class="mt-4 btn btn-lg btn-primary" :disabled="disabled == 1">Valider</button>
    </form>    
</template>

<script>
export default {
    data() {
        return {
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
            this.errors = [];
            if(this.hasPassword == 1) {
                if(!this.password) this.errors.push('Le mot de passe est requis');
                else if(this.password.length < 4) this.errors.push('Le mot de passe doit avoir plus de 4 caractères');
                else if(this.password.length > 20) this.errors.push('Le mot de passe doit avoir moins de 20 caractères');
            } 

            if(!this.errors.length) {
                this.disabled = 1;
                this.$store.dispatch('channel/checkPassword', { channel: this.channel, password: this.password })
                .then(data => {
                    console.log('inside PasswordForm', data);
                    if(data.channel.id && data.user.username) {
                        this.$store.commit('message/setMessage', { type: 'success', text: 'Connexion à la partie ' + this.channel.name + ' réussie' });
                    }
                    this.disabled = 0;
                })                
                .catch((data) => {
                    console.log('promise error inside PasswordForm', data);
                    this.$store.commit('message/setMessage', { type: 'danger', text: 'Mot de passe incorrect' });
                    this.disabled = 0;
                });
            }
        } 
    }
}
</script>

<style>

</style>