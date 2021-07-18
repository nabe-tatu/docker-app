<template>
  <div>
    <tweet-card
        v-for="(tweet, index) in tweets"
        :tweet="tweet"
        :key="index">
    </tweet-card>
  </div>
</template>

<script>
import TweetCard from "@/component/tweet/tweetCard/TweetCard";

export default {
  name: "TweetList",
  components: {TweetCard},
  props: {
    tweets: {
      type: Array,
      require: false,
      default: null
    },
  },
}
</script>

<style scoped>

</style>
