<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <router-link class="navbar-brand" :to="{ name: 'home'}">Stories</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{ name: 'home'}">Accueil</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'about'}">A propos</router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <template v-if="hasMessage">
            <Message></Message>
        </template>
        <router-view></router-view>
    </div>
</template>
    
<script>
    import Message from './components/FlashMessage';

    export default {
        components: { Message },
        data() {
            return {
                hasParty: true
            }
        },
        computed: {
            hasMessage: function() {
                return this.$store.getters['message/isDisplayed'];
            }
        },
        mounted() {
        },
    };
</script>

<style>

</style>