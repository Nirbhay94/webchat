<template>
    <div class="chat-members" style="padding: 5px">
        <chat-member v-for="member in members" v-bind:member="member" :key="member.id"></chat-member>
    </div>
</template>

<script>
    module.exports = {
        props:['members']
    }
</script>
<style lang="css">
</style>
