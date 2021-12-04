<template>
    <div>
<!--        &lt;!&ndash; TODO::vuex &ndash;&gt;-->
<!--        <h1 v-for="user in users" :key="user.name">{{ user.name }}</h1>-->
<!--        <p><button v-on:click="incrementOne">UP</button>-->
<!--        <h1>Count:{{ count }}</h1>-->
<!--        &lt;!&ndash;モジュール化&ndash;&gt;-->
<!--        <h1>{{ $store.state.user.user }}</h1>-->

<!--        <p><button v-on:click="load()">UP</button>-->
<!--        <h1>{{ $store.state.user.authUser }}</h1>-->
        <router-view></router-view>
    </div>
</template>

<script>
export default {
  name: 'App',
    created: function () {
        setTimeout(this.load,1000);
    },
    methods: {
        load: function () {
            if (this.isLoading()) {
                this.loadAuthUserData();
            }
        },
        loadAuthUserData : function(){
            this.$store.commit('loadAuthUserData');
        },
        isLoading: function () {
            const path = this.$route.path;
            return !(path === "/login" || path === "/forgetPassword" || path === "/register");
        },
        // increment : function(){
        //     this.$store.commit('increment',10)
        // },
        // incrementOne : function(){
        //     this.$store.dispatch('incrementOne',1)
        // }
    },
    computed : {
        users: function(){
            return this.$store.getters.users;
        },
        count : function(){
            return this.$store.state.count
        }
    }
}
</script>

<style lang="scss">
  // Import Main styles for this application
  @import 'assets/scss/style';
</style>
