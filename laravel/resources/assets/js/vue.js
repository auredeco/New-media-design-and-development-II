import Vue from 'vue';
import Message from './components/Message.vue'

console.log('loaded');
let data = {
    message: 'hello world'
};

new Vue({
    el: '#app',

    components: { Message }
})