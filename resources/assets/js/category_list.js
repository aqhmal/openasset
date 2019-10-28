import Vue from 'vue'
import VueSweetAlert from 'vue-sweetalert'
import categorieslist from './components/CategoryList.vue'


const app = new Vue({
    el: '#list',
    components: {
      categorieslist
    }
});
