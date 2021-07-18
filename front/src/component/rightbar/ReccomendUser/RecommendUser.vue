<template>
<div>
    <h3>おすすめユーザー</h3>
    <user-list :users="recommendUsers"></user-list>
</div>
</template>

<script>
import UserList from "@/component/user/userList/UserList";
export default {
    name: "RecommendUser",
    components: {UserList},
    props: {
        recommendUsers: {
            type: Array,
            require: false,
            default: null
        }
    },
}
</script>

<style scoped>

</style>
