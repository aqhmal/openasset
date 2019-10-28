import Vue from 'vue'
import VueSweetAlert from 'vue-sweetalert'
import borrowlist from './components/BorrowList.vue'


const app = new Vue({
    el: '#list',
    components: {
      borrowlist
    }
});
