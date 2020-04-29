<template>
    <div>
        <div v-if="isPlaying">
            <button>Lancer dé</button>
        </div>
        <div v-else>
            <button>Lancé dé noir</button>
        </div>
    </div>
</template>

<script>


export default {
    props: {
        isPlaying: Boolean
    },
    computed: {

    }
}
</script>

<style>

</style>