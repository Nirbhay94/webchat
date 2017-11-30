<template>

    <div class="live-chat" v-bind:id="'chat_box'+user.id" style="display: none">

        <header class="clearfix" @click="toggleBox">

            <a class="chat-close" @click="removeChat(user.id)">x</a>

            <h4>{{ user.name }}</h4>

            <span class="personal-message-counter">3</span>

        </header>
        <transition name="fade">
            <div class="chat" v-if="show">
                <personal-log v-bind:pmessages="pmessages[user.id]"></personal-log>

                <!--<p class="chat-feedback">Your partner is typing…</p>-->

                <personal-composer v-on:psentmessage="pAddMessage" v-bind:user="user"></personal-composer>

            </div> <!-- end chat -->
        </transition>
    </div> <!-- end live-chat -->
</template>
<script>
    export default {
        data: function () {
            return {
                show:true
            }
        },
        props:['user','pmessages'],

        methods:
            {
                pAddMessage(message)
                {

                    axios.post('/pmessages',message).then(response => {
                        this.pmessages[this.user.id].push(response.data.pmessage);
                        setTimeout(function () { this.scrollBottom(this.user.id) }.bind(this), 200);
                    });
                },
                scrollBottom(id)
                {
                    var container = document.getElementById("chat_box"+id).getElementsByClassName("personal-log")[0];
                    container.scrollTop = container.scrollHeight;
                },
                toggleBox()
                {
                    this.show = ((this.show) ? false : true);
                    setTimeout(function () { this.scrollBottom(this.user.id) }.bind(this), 200);
                },
                removeChat(id)
                {
                    document.getElementById("chat_box"+id).style.display="none";
                }

            },
        created()
        {

            window.bus.$on('personal-messages', (data) => {
                this.pmessages[data.member.id] = data.pmessages;
            });
            window.Echo.join('pchatroom')
                .listen('PMessagePosted', (e) => {
                    this.pmessages[this.user.id].push({
                        message:e.personalChat.message,
                        user:e.user,
                        created_at:e.personalChat.created_at
                    });
                    setTimeout(function () { this.scrollBottom(e.user.id) }.bind(this), 200);
                });

        },


    }

</script>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0
    }
</style>
