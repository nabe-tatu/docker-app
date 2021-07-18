<script>
    const host = `${process.env.VUE_APP_API_URL}`;
    export default {
        name: "ApiRouter",
        data: function () {
            return {
                routes: {
                    tweets: host + "/api/v1/tweets",
                    tweet: function (id) {
                        return host + "/api/v1/tweets/" + id;
                    },
                    recommendUsers: host + "/api/v1/recommendUsers",
                }
            }
        }
    }
</script>
