<template>
    <div>
        <div v-if="isPlaying">
            <button>Lancer dé</button>
        </div>
        <div v-else>
            <Input/>
            <button>Valider</button>
        </div>
    </div>
</template>

<script>


export default {
    props: {
        isPlaying: Boolean
    },

}
</script>

<style>

</style>