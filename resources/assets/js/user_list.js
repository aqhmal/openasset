import Vue from 'vue'
import VueSweetAlert from 'vue-sweetalert'
import userlist from './components/UserList.vue'


const app = new Vue({
    el: '#list',
    components: {
      userlist
    }
});
