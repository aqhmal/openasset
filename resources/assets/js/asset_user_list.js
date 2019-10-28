import Vue from 'vue'
import VueSweetAlert from 'vue-sweetalert'
import assetlist from './components/UserAssetList.vue'


const app = new Vue({
    el: '#list',
    components: {
      assetlist
    }
});
