<template>
    <div class="container">
        <div class="chat-log">
            <ul class="list-group">
                <chat-message v-for="message in messages" v-bind:message="message" :key="message.id"></chat-message>
            </ul>
        </div>
    </div>

</template>

<script>
    module.exports = {
       props:['messages']
    }
</script>
<style lang="css">
</style>
