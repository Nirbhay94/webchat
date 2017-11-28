<template>
        <div class="personal-message " >

            <!--<img src="http://lorempixum.com/32/32/people" alt="" width="32" height="32">-->

            <div class="personal-message-content clearfix">

                <span class="chat-time">{{ pmessage.created_at }}</span>

                <h5>{{ pmessage.user.name }}</h5>

                <p>{{ pmessage.message }}</p>

            </div> <!-- end chat-message-content -->
            <hr>
        </div> <!-- end chat-message -->


</template>

<script>

    module.exports = {

        props: ['pmessage']
    }
</script>
