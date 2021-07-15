<template>
<div>
    <h3>おすすめトピック</h3>
    <tweet-list></tweet-list>
</div>
</template>

<script>
import TweetList from "@/component/tweet/tweetList/TweetList";
export default {
    name: "RecommendTopic",
    components: {TweetList}
}
</script>

<style scoped>

</style>
