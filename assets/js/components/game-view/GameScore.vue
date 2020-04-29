<template>
    <div>
        <div v-for="(message, index) in messages" :key="index">
            <span>{{ message['username'] }}</span>
            <span>{{ message['text'] }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        messages: Array,
        users: Array
    }
}
</script>

<style>

</style>