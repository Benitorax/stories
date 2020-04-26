<template>
    <div>
        <div>Partie: {{ channel.name }}</div>
        <div>Joueur: {{ user.username }}</div>
    </div>
</template>

<script>
export default {
    props: {
        channel: Object,
        user: Object
    }
}
</script>

<style>

</style>