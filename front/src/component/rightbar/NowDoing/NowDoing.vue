<template>
<div>
    <h3>今どうしてる？</h3>
    <tweet-list></tweet-list>
</div>
</template>

<script>
import TweetList from "@/component/tweet/tweetList/TweetList";
export default {
    name: "NowDoing",
    components: {TweetList}
}
</script>

<style scoped>

</style>
