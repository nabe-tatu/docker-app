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
                    recommendUsers: host + "/api/v1/recommendUsers",
                    register: host + "/api/register",
                    sendResetPasswordUrl: host + "/api/sendResetPasswordUrl",
                    resetPassword: host + "/api/resetPassword",
                }
            }
        }
    }
</script>
