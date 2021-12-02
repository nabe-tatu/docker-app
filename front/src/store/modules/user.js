//vue x モジュール化
export const user = {
    namespaced: true,
    state: {
        user: 111111,
        authUser: 2222222
    },
    getter: {

    },
    mutations: {
        loadAuthUserData: function (state) {
            console.log('loadAuthUserData');
            window.axios.get(`${process.env.VUE_APP_API_URL}` + "/api/v1/loginUser")
                .then(response => {
                    state.authUser = response.data.data;
                })
                .catch(() => {
                    // this.handleErrorStatusCode(error);
                });
        },
        setUser(state, payload) {
            state.user = payload;
        },
    },
    actions: {
        login({ commit }) {
            console.log(commit, 11111);
        },
        logout({ commit }) {
            console.log(commit, 22222);
        },
    },
    getters:{
    },
};
