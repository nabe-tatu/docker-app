<template>
<div>
    <h1>つぶやき一覧</h1>
    <tweet-list></tweet-list>
</div>
</template>

<script>
import TweetList from "@/component/tweet/tweetList/TweetList";
export default {
name: "Tweet",
    components: {TweetList}
}
</script>

<style scoped>

</style>
