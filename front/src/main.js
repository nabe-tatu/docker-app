import 'core-js/stable'
import Vue from 'vue'
import App from './App'
import router from './router'
import CoreuiVue from '@coreui/vue'
import {iconsSet as icons} from './assets/icons/icons.js'
import store from './store'
// import axios from 'axios' //追記
// import VueAxios from 'vue-axios' //追記

Vue.config.performance = true
Vue.use(CoreuiVue)
Vue.prototype.$log = console.log.bind(console)
require("./bootstrap");
// Vue.use(VueAxios, axios)

// import BootstrapVue from 'bootstrap-vue'
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
// Vue.use(BootstrapVue)

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
        String(this.$route.path);
        if (!(this.$route.path === "/remind/" + this.$route.path.split("/remind/").join("") ||
            this.$route.path === "/login" ||
            this.$route.path === "/password/reset")
        ) {
            this.loadAuthUserData();
        }
    },
    methods: {
        loadAuthUserData: function () {
            window.axios.get(`${process.env.VUE_APP_API_URL}` + "/api/v1/loginUser")
                .then(response => {
                    this.$root.loginUser = response.data.data;
                })
                .catch(() => {
                    // this.handleErrorStatusCode(error);
                });
        }
    },
})
