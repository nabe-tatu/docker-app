<template>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <tweet-list></tweet-list>
            </div>
            <div class="col-4">
                <right-bar></right-bar>
            </div>
        </div>
    </div>
</template>

<script>
import TweetList from "@/component/tweet/tweetList/TweetList";
import RightBar from "@/component/rightbar/RightBar/RightBar";
export default {
name: "Tweet",
    components: {RightBar, TweetList}
}
</script>

<style scoped>

</style>
