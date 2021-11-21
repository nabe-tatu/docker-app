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
                    users: host + "/api/v1/users",
                    user: function (id) {
                        return host + "/api/v1/users/" + id;
                    },
                    getRecommendUser: host + "/api/v1/getRecommendUser",
                    register: host + "/api/register",
                    sendResetPasswordUrl: host + "/api/sendResetPasswordUrl",
                    resetPassword: host + "/api/resetPassword",
                }
            }
        }
    }
</script>
