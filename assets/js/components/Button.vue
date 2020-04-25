<template>
    <button type="button" class="btn" :class="buttonClass">
        <router-link :class="textColor" :to="to">{{ buttonText }}</router-link>
    </button>
</template>

<script>
export default {
    props: {
        buttonClass: String,
        buttonText: String,
        textColor: String,
        to: String
    }
}
</script>

<style>

</style>