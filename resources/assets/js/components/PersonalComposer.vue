<template>
        <div class="personal-composer">
            <input type="text" id="pmessage" placeholder="Type here!" v-model="pMessageText" @keyup.enter="pSendMessage">
        </div>
</template>

<script>
    module.exports = {
        data: function () {
            return {
                pMessageText : '',
            }
        },
        props:['user'],
        methods:
            {
                pSendMessage()
                {
//                    console.log(this.chatUser);
                    this.$emit('psentmessage',{
                        message:this.pMessageText,
                        to_id:this.user.id,
                        user: {
                            name: window.user.name
                        },
                        created_at: moment.utc().format("HH:mm A")
                    });

                    this.pMessageText = '';
                }
            }
    }
</script>

<style>
    .personal-composer
    {
        display:flex;
    }
    .personal-composer input
    {
        flex: 1 auto;

    }
    .personal-composer button
    {
        border-radius:0;
    }
</style>

