<template>
    <div class="container" v-if="tweets">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <tweet-list
                    class="scroll"
                    :tweets="tweets"></tweet-list>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <v-input placeholder="キーワード検索"></v-input>
                <right-bar
                    class="scroll"
                    :recommendUsers="recommendUsers"></right-bar>
            </div>
        </div>
    </div>
</template>

<script>
import TweetList from "@/component/tweet/tweetList/TweetList";
import RightBar from "@/component/rightbar/RightBar/RightBar";
import ApiRouter from "@/component/Systems/ApiRouter";
import ErrorHandler from "@/component/Systems/ErrorHandler";
import VInput from "@/component/form/VInput";

export default {
name: "Tweet",
    components: {VInput, RightBar, TweetList},
    mixins: [ApiRouter, ErrorHandler],
    created: function() {
        this.loadTweetData();
        this.loadRecommendUserData();
    },
    data: function () {
        return {
            tweets: null,
            recommendUsers: null
        }
    },
    methods: {
        loadTweetData: function () {
            window.axios.get(this.routes.tweets)
                .then((response) => {
                    this.tweets = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        loadRecommendUserData: function () {
            window.axios.get(this.routes.getRecommendUser, {
                status: 10
            })
                .then((response) => {
                    this.recommendUsers = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>
.scroll{
    height: 100vh;
    overflow: auto;
}
</style>
