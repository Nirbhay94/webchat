<template>
    <div class="container">
        <div class="chat-composer">
            <input type="text" id="message" placeholder="Type here!" v-model="messageText" @keyup.enter="sendMessage">
            <button class="btn btn-primary" @click="sendMessage">Send</button>
        </div>
    </div>
</template>
<script>
    module.exports = {
        data: function () {
            return {
                messageText : '',
            }
        },
        methods:
            {
                sendMessage()
                {
                    this.$emit('sentmessage',{
                        message:this.messageText,
                        user: {
                            name: window.user.userName
                        },
                        created_at: moment.utc().format("YYYY-MM-DD HH:mm:ss")
                    });

                    this.messageText = '';
                }
            }
    }
</script>

<style>
    .chat-composer
    {
        display:flex;
    }
    .chat-composer input
    {
        flex: 1 auto;

    }
    .chat-composer button
    {
        border-radius:0;
    }
</style>

