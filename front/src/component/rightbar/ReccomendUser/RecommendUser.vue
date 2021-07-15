<template>
<div>
    <h3>おすすめユーザー</h3>
    <tweet-list></tweet-list>
</div>
</template>

<script>
import TweetList from "@/component/tweet/tweetList/TweetList";
export default {
    name: "RecommendUser",
    components: {TweetList}
}
</script>

<style scoped>

</style>
