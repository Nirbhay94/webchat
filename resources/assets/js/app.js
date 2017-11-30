
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));
Vue.component('chat-members', require('./components/ChatMembers.vue'));
Vue.component('chat-member', require('./components/ChatMember.vue'));
Vue.component('chat-boxes', require('./components/ChatBoxes.vue'));
Vue.component('chat-box', require('./components/ChatBox.vue'));
Vue.component('personal-message', require('./components/PersonalMessage.vue'));
Vue.component('personal-log', require('./components/PersonalLog.vue'));
Vue.component('personal-composer', require('./components/PersonalComposer.vue'));

window.bus = new Vue();
const app = new Vue({
    el: '#app',
    data:  {
        messages :[],
        members:[],
    },
    methods:
        {
            addMessage(message)
            {
                this.messages.push(message);
                axios.post('/messages',message).then(response => {

                });
            },
        },
    created: function () {
        axios.get('/messages').then(response => {
            this.messages = response.data.messages
        });
        Echo.join('chatroom')
            .here((users) => {
                this.members = users;
            })
            .joining((user) => {
                this.members.push(user);
            })
            .leaving((user) => {
                this.members.pop(user);
            })
            .listen('MessagePosted', (e) => {
                this.messages.push({
                    message:e.messages.message,
                    user:e.user,
                    created_at:e.messages.created_at
                });
            });

    }

});

