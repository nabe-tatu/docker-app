<template>
<div>
    <user-card
        v-for="(user, index) in users"
        :key="index"
        :user="user">
    </user-card>
</div>
</template>

<script>
import UserCard from "@/component/user/userCard/UserCard";
export default {
name: "UserList",
    components: {UserCard},
    props: {
        users: {
            type: Array,
            require: false,
            default: null
        },
    },
}
</script>

<style scoped>

</style>
