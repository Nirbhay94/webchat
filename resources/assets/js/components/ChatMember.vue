<template>
        <p>{{ member['name'] }} <a v-if="(member['id'] != user_id)"   @click="openChat(member)" class="pull-right" style="margin-right: 10px"><i class="fa fa-comment-o" aria-hidden="true"></i></a></p>
</template>

<script>
    import bus from '../app.js';
    export default {
        data: function () {
            return {
                user_id : window.user.id
            }
        },
        props: ['member'],
        methods:
            {
                openChat(member)
                {
                    axios.get('chat/'+member.id).then(response => {
                        window.bus.$emit('personal-messages', {'pmessages':response.data.pmessages,'member':member});
                    });
                    window.bus.$emit('show-chat', true);
                },

            }
    }
</script>
