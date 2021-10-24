<script>
export default {
    name: "Utils",
    data: function () {
        return {
            noImage: '/image/noimage.png'
        }
    },
    methods: {
        clearError: function (key) {
            this.$delete(this.errors, key)
        },
        sendingTrue: function () {
            this.sending = true;
        },
        sendingFalse: function () {
            this.sending = false;
        },
    }
}
</script>
