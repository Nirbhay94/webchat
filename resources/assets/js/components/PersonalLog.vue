<template>
        <div class="chat-history personal-log" id="personalLog">
            <personal-message v-for="pmessage in pmessages" v-bind:pmessage="pmessage" :key="pmessage.id"></personal-message>
        </div>
</template>

<script>
    module.exports = {
        props:['pmessages']
    }
</script>
<style lang="css">
</style>
