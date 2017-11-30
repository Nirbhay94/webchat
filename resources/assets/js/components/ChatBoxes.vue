<template>

    <div class="chat-boxes">
        <chat-box v-for="user in members" v-bind:user="user" :key="user.id" v-bind:pmessages="pmessages"></chat-box>
    </div>
</template>
<script>

    export default {
        data: function () {
            return {
                pmessages:[],
            }
        },
        props: ['members'],
        methods:
            {
                scrollBottom(id)
                {
                    var container = document.getElementById("chat_box"+id).getElementsByClassName("personal-log")[0];
                    container.scrollTop = container.scrollHeight;
                },


            },
        created()
        {

            axios.get('pmessages').then(response => {
                this.pmessages = response.data.pmessages;
            });
            window.bus.$on('personal-messages', (data) => {
                this.pmessages[data.member.id] = data.pmessages;
            });
            window.bus.$on('show-chat', (value) => {
                var liveChatCount = window.$('.live-chat:visible').length + 1;
                var id = value.member.id;
                if(liveChatCount != 1)
                {
                    if(!window.$('#chat_box'+id).is(':visible'))
                    {
                        document.getElementById("chat_box"+id).style.marginRight=(liveChatCount*160)+'px';
                    }

                }
                document.getElementById("chat_box"+id).style.display="";
                setTimeout(function () { this.scrollBottom(id) }.bind(this), 200);

            });

        }
    }
</script>



