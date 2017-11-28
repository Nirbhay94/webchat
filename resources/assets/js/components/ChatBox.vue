<template>
    <div id="live-chat" v-if="showChat">

        <header class="clearfix">

            <a class="chat-close" @click="showChat = false">x</a>

            <h4>{{ chatUser.name }}</h4>

            <span class="personal-message-counter">3</span>

        </header>

        <div class="chat">
            <personal-log v-bind:pmessages="pmessages"></personal-log>

            <!--<p class="chat-feedback">Your partner is typing…</p>-->

            <personal-composer v-on:psentmessage="pAddMessage" v-bind:chatUser="chatUser"></personal-composer>

        </div> <!-- end chat -->

    </div> <!-- end live-chat -->
</template>
<script>
    export default {
        data: function () {
            return {
                pmessages : [],
                showChat: false,
                chatUser :''
            }
        },
        methods:
            {
                pAddMessage(message)
                {
//                    console.log(message);
                    this.pmessages.push(message);
                    axios.post('/pmessages',message).then(response => {
                        setTimeout(function () { this.scrollBottom() }.bind(this), 200);
                    });
                },
                scrollBottom()
                {
                    var container = document.getElementById("personalLog");
                    container.scrollTop = container.scrollHeight;
                }

            },
        created()
        {
            window.bus.$on('show-chat', (value) => {
                this.showChat = value;
                setTimeout(function () { this.scrollBottom() }.bind(this), 200);

            });
            window.bus.$on('personal-messages', (data) => {
                this.pmessages = data.pmessages;
                this.chatUser = data.member;
            });
            window.Echo.join('pchatroom')
                .listen('PMessagePosted', (e) => {
                    this.pmessages.push({
                        message:e.personalChat.message,
                        user:e.user,
                        created_at:e.personalChat.created_at
                    });
                    setTimeout(function () { this.scrollBottom() }.bind(this), 200);
                });

        }
    }
</script>

<style>


</style>

