import 'core-js/stable'
import Vue from 'vue'
import App from './App'
import router from './router'
import CoreuiVue from '@coreui/vue'
import {iconsSet as icons} from './assets/icons/icons.js'
// import store from './store/index.js'//index.jsならファイル名の指定いらない？？
import store from './store.js'
import Vuex from 'vuex'

Vue.use(Vuex)
Vue.use(CoreuiVue)
Vue.config.performance = true
Vue.prototype.$log = console.log.bind(console)
require("./bootstrap");

new Vue({
    el: '#app',
    router,
    store,
    icons,
    template: '<App/>',
    components: {
        App
    },
    data: function () {
        return {
            loginUser: null,
        };
    },
    created: function () {
        setTimeout(this.load,1000);
    },
    methods: {
        // loadAuthUserData: function () {
        //     window.axios.get(`${process.env.VUE_APP_API_URL}` + "/api/v1/loginUser")
        //         .then(response => {
        //             this.$root.loginUser = response.data.data;
        //             console.log(this.$root.loginUser,'this.$root.loginUser')
        //         })
        //         .catch(() => {
        //             // this.handleErrorStatusCode(error);
        //         });
        // },
        // isLoading: function () {
        //     const path = this.$route.path;
        //     return !(path === "/login" || path === "/forgetPassword" || path === "/register");
        // },
        // load: function () {
        //     if (this.isLoading()) {
        //         this.loadAuthUserData();
        //     }
        // }
    },
})
