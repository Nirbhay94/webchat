<template>
        <li class="chat-message list-group-item">
            <p>{{ message.message }}</p>
            <small>{{ message.user.name }}</small>
            <p class="pull-right">{{ message.created_at }}</p>
        </li>
</template>

<script>

    module.exports = {

        props: ['message']
    }
</script>
