<template>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-5">Home</h1>
            <div class="mb-2">
                <Button to="/channel/create" textColor="text-white" buttonText="Create a channel" buttonClass="btn-lg btn-primary" ></Button>
            </div>
            <div class="mb-2">
                <Button to="/channel/connect" textColor="text-white" buttonText="Join a channel" buttonClass="btn-lg btn-primary" ></Button>
            </div>
            <div class="mb-2">
                <Button to="/channel/list" textColor="text-white" buttonText="Watch a channel" buttonClass="btn-lg btn-primary" ></Button>
            </div>
        </div>
    </div>
</template>
    
<script>
import Button from '../components/Button';
export default {
    components: { Button }
}
</script>

<style>

</style>