<template>
<div>
    リスト
    <tweet-card></tweet-card>
</div>
</template>

<script>
import TweetCard from "@/component/tweet/tweetCard/TweetCard";
export default {
    name: "TweetList",
    components: {TweetCard}
}
</script>

<style scoped>

</style>
