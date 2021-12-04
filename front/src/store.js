import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
    sidebarShow: 'responsive',
    sidebarMinimize: false,
    authUser: null
}

const mutations = {
    toggleSidebarDesktop(state) {
        const sidebarOpened = [true, 'responsive'].includes(state.sidebarShow)
        state.sidebarShow = sidebarOpened ? false : 'responsive'
    },
    toggleSidebarMobile(state) {
        const sidebarClosed = [false, 'responsive'].includes(state.sidebarShow)
        state.sidebarShow = sidebarClosed ? true : 'responsive'
    },
    set(state, [variable, value]) {
        state[variable] = value
    },
    loadAuthUserData: function (state) {
        window.axios.get(`${process.env.VUE_APP_API_URL}` + "/api/v1/loginUser")
            .then(response => {
                state.authUser = response.data.data;
            })
            .catch(() => {
                // this.handleErrorStatusCode(error);
            });
    },
}

export default new Vuex.Store({
    state,
    mutations
})
