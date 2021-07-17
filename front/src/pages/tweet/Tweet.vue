<template>
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <tweet-list class="scroll"></tweet-list>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <v-input placeholder="キーワード検索"></v-input>
                <right-bar class="scroll"></right-bar>
            </div>
        </div>
    </div>
</template>

<script>
import TweetList from "@/component/tweet/tweetList/TweetList";
import RightBar from "@/component/rightbar/RightBar/RightBar";
import VInput from "@/component/form/VInput/VInput";
export default {
name: "Tweet",
    components: {VInput, RightBar, TweetList}
}
</script>

<style scoped>
.scroll{
    height: 100vh;
    overflow: auto;
}
</style>
