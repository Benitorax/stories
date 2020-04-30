<template>
    <div>
        <div v-if="isPlaying">
            <button :disabled="disabled == 1" v-for="button in buttons" :data-value="button.data" :key="button.id" class="btn btn-primary" v-on="onSelectVersion('normal')">{{button.text}}</button>
        </div>
        <div v-else>
            <p v-if="errors.length" class="text-danger">
                <b>Veuillez corriger ces erreurs :</b>
                <ul>
                    <li :key="index" v-for="(error, index) in errors">{{ error }}</li>
                </ul>
            </p>

            <Input :disabled="disabled == 1" type="text" v-model="subject"/>
            <button :disabled="disabled == 1" v-on="submitSubject">Valider</button>
        </div>
    </div>
</template>

<script>
import { rollNumberDice, proposeSubject } from '../../service/CommandService';

export default {
    data() {
        return {
            disabled: 0,
            className: 'btn-primary',
            buttons: [
                {id: 1, text: 'Normal', data: 1},
                {id: 2, text: 'Dé blanc', data: 2},
                {id: 3, text: 'Auto', data: 3},
            ],
            subject: '',
            errors: []
        };
    },
    props: {
        isPlaying: Boolean,
        channel: Object,
        user: Object
    },
    methods: {
        onSelectGameVersion: function(version) {
            selectGameVersion({ channel: this.props.channel, token: user.token, version }).then(data => {
                this.$store.commit('user/setUser', data.user);
                this.$store.commit('user/setChannel', data.channel);
            }).catch(data => {
                console.log('error in CommandSelectGame', data);
                this.$store.commit('message/setMessage', { type: 'danger', text: 'server problem' });

            });
        },
        onSubmitSubject: function(e) {
            e.preventDefault();
            this.errors = [];

            if(!this.subject) this.errors.push('Le sujet est requis');
            else if(this.subject.length < 15) this.errors.push('Le sujet doit avoir plus de 15 caractères');
            else if(this.subject.length > 200) this.errors.push('Le sujet doit avoir moins de 200 caractères');

            if(!this.errors.length) {
                this.disabled = 1;

                proposeSubject({ channel: this.props.channel, token: user.token, subject: this.subject})
                .then(data => {
                    this.$store.commit('user/setUser', data.user);
                    this.$store.commit('user/setChannel', data.channel);
                    this.disabled = 0;
                })                
                .catch((data) => {
                    console.log('error in CommandSelectGame', data);
                    this.$store.commit('message/setMessage', { type: 'danger', text: 'server problem' });
                    this.disabled = 0;
                });
            }

        }
    }

}
</script>

<style>

</style>