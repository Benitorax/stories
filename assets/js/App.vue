<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Stories</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/">Accueil</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/a-propos">A propos</router-link>
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