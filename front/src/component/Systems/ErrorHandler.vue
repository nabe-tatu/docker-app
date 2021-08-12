<script>
import Swal from "sweetalert2";
import 'sweetalert2/src/sweetalert2.scss';

export default {
    name: "ErrorHandler",
    data: function () {
        return {
            errors: {}
        }
    },
    methods: {
        handleErrorStatusCode: function (error) {
            if (error.response) {
                switch (error.response.status) {
                    case 401:
                        this.unauthenticatedHandle();
                        break;
                    case 403:
                        this.unauthorizationHandle();
                        break;
                    case 409:
                        this.exclusiveControlHandle(error.response.data);
                        break;
                    case 418:
                        this.unprocessableEntity(error.response.data);
                        break;
                    case 422:
                        this.inputErrorHandle(error);
                        break;
                    default:
                        this.systemErrorHandle(error.response.status);
                        break;
                }
            } else {
                this.showErrorPopup("エラーです。", error.response.data);
            }
        },
        unauthenticatedHandle: function () {
            Swal.fire({
                title: '認証エラーです。',
                text: 'セッションは期限切れです。 もう一度ログインしてください。',
                type: 'warning',
                confirmButtonColor: '#73C8EB',
                confirmButtonText: 'ログイン',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then(() => {
                location.href = "/login";
            })
        },
        unauthorizationHandle: function () {
            this.showErrorPopup("権限エラーです。", "このコンテンツにアクセスする権限がありません。", 'warning');
        },
        exclusiveControlHandle: function () {
            this.showErrorPopup("排他エラーです。", "すでに変更されたデータの可能性があります。最新の状態で再度実行してください。", 'warning');
        },
        unprocessableEntity: function (message) {
            this.showErrorPopup("エラーです。", message);
        },
        inputErrorHandle: function (error) {
            this.showErrorPopup("入力エラーです。", "入力に1つ以上のエラーがあります。");
            this.errors = error.response.data.errors;
        },
        hasErrors: function (key) {
            return this.errors[key] ? this.errors[key] : [];
        },
        clearErrors: function () {
            this.errors = {};
        },
        showSuccessPopup: function (message = null, type = 'success') {
            Swal.fire({
                title: message,
                type: type,
                showConfirmButton: false,
                timer: 1500
            });
        },
        showErrorPopup: function (title, message = null, type = 'error') {
            Swal.fire({
                type: type,
                title: title,
                text: message,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#73C8EB',
                confirmButtonText: '了解',
            })
        },
        systemErrorHandle: function (statusCode) {
            this.showErrorPopup('システムエラーです。', 'エラーコード:' + statusCode);
        },
        showIndicator: function (message = 'Loading...') {
            Swal.fire({
                title: message,
                text: "しばらくお待ちください",
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                },
                imageUrl: '',
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'Logo',
                allowOutsideClick: false,
                allowEscapeKey: false
            })
        },
        showProgressBar: function (message = 'Updating...') {
            Swal.fire({
                title: message,
                html: "<b></b>",
                willOpen: () => {
                    Swal.showLoading();
                },
                imageUrl: '',
                imageWidth: 100,
                imageHeight: 100,
                imageAlt: 'Logo',
                allowOutsideClick: false,
                allowEscapeKey: false
            })
        },
        showSyncIndicator: function () {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            }).then(() => {
                Swal.getContainer().remove();
            })
        },
        hideIndicator: function () {
            Swal.close();
        },
        showDeleteConfirmPopup: function (callback) {
            Swal.fire({
                title: '削除',
                text: "削除します、よろしいですか？",
                type: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#fc0202',
                cancelButtonColor: '#818181',
                confirmButtonText: '削　除',
                cancelButtonText: 'キャンセル'
            }).then((result) => {
                if (result.value) {
                    callback();
                }
            })
        },
        showCreateConfirmPopup: function (callback) {
            Swal.fire({
                title: '追加',
                text: '追加してよろしいですか？',
                type: 'success',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#73C8EB',
                cancelButtonColor: '#818181',
                confirmButtonText: '追　加',
                cancelButtonText: 'キャンセル'
            })
                .then((result) => {
                    if (result.value) {
                        callback();
                    }
                });
        },
        showRestoreConfirmPopup: function (callback) {
            Swal.fire({
                title: '復元',
                text: '復元してよろしいですか？',
                type: 'success',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#73C8EB',
                cancelButtonColor: '#818181',
                confirmButtonText: '復　元',
                cancelButtonText: 'キャンセル'
            })
                .then((result) => {
                    if (result.value) {
                        callback();
                    }
                });
        },
        changeStatusConfirmPopup: function (callback) {
            Swal.fire({
                title: 'ステータス変更',
                text: '変更してよろしいですか？',
                type: 'success',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonColor: '#73C8EB',
                cancelButtonColor: '#818181',
                confirmButtonText: '変　更',
                cancelButtonText: 'キャンセル'
            })
                .then((result) => {
                    if (result.value) {
                        callback();
                    }
                });
        },
    }
}
</script>
