<template>
    <div class="jumbotron jumbotron-fluid bg-white">
        <div class="container">
            <h1 class="display-5">Home</h1>
            <div class="mb-2">
                <ButtonLink routeName="channel-create" buttonText="Create a channel" buttonClass="btn-lg btn-primary" ></ButtonLink>
            </div>
            <div class="mb-2">
                <ButtonLink routeName="channel-list" buttonText="Join a channel" buttonClass="btn-lg btn-primary" ></ButtonLink>
            </div>
        </div>
    </div>
</template>
    
<script>
import ButtonLink from '../components/ButtonLink';
export default {
    components: { ButtonLink }
}
</script>

<style>

</style>