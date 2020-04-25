<template>
    <router-link :to="{ name: routeName, params: routeParams }">
        <button type="button" class="btn" :class="buttonClass">
            {{ buttonText }}
        </button>
    </router-link>
</template>

<script>
export default {
    props: {
        buttonClass: String,
        buttonText: String,
        routeName: String,
        routeParams: String
    }
}
</script>

<style>

</style>