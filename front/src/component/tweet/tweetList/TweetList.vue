<template>
<div>
    <tweet-card v-for="n in 10" :key="n"></tweet-card>
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
