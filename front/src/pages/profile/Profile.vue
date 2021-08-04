<template>
    <div class="container py-3">
        <div class="row">
            <div class="col-8 mx-auto">
                <form>
                    <v-input id="profile-nickname"
                             type="text"
                             maxlength="30"
                             label="ニックネーム"
                             placeholder="ニックネーム">

                    </v-input>
                    <v-input id="profile-name"
                             type="text"
                             maxlength="30"
                             label="本名"
                             placeholder="本名">

                    </v-input>
                    <v-text-area id="profile-introduction"
                                 type="text"
                                 maxlength="100"
                                 label="自己紹介"
                                 placeholder="自己紹介">

                    </v-text-area>
                    <v-input id="profile-mail"
                             type="text"
                             maxlength="100"
                             label="メールアドレス"
                             placeholder="メールアドレス">

                    </v-input>
                    <v-file id="profile-image"
                            accept="image/*"
                            label="プロフィール画像">

                    </v-file>
                    <v-file id="profile-background-image"
                            accept="image/*"
                            label="背景画像">

                    </v-file>
                    <v-input id="profile-password"
                             type="password"
                             maxlength="30"
                             :disabled=isChangePass
                             label="パスワード"
                             placeholder="パスワード">

                    </v-input>
                    <v-input id="profile-password-new"
                             type="password"
                             maxlength="30"
                             :disabled=isChangePass
                             label="新しいパスワード"
                             placeholder="新しいパスワード">

                    </v-input>
                    <v-input id="profile-password-new"
                             type="password"
                             maxlength="30"
                             :disabled=isChangePass
                             label="新しいパスワード(確認用)"
                             placeholder="新しいパスワード(確認用)">

                    </v-input>
                    <div class="form-group form-check">
                        <input @click="check"
                               id="profile-checkbox"
                               type="checkbox"
                               class="form-check-input">
                        <label class="form-check-label"
                               for="profile-checkbox">
                            パスワードを変更する
                        </label>
                    </div>
                    <button class="btn btn-primary float-right"
                            @click="updateProfile">
                        変更を適用する
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import VInput from "@/component/form/VInput";
import VTextArea from "@/component/form/VTextArea";
import VFile from "@/component/form/VFile";

export default {
    name: "Profile",
    components: {VFile, VTextArea, VInput},
    data: function () {
        return {
            form: {
                screen_name: '',
                name: '',
                introduction: '',
                profile_image: '',
                background_image: '',
                email: '',
                email_verified_at: '',
                old_password: '',
                new_password: '',
                new_password_confirm: ''
            },
            isChangePass: true
        }
    },
    methods: {
        updateProfile: function () {
            // this.showIndicator('更新中');
            this.sending = true;

            window.axios.patch(this.routes.user(this.id), this.form)
                .then(response => {
                    console.log(response,1111111111111);
                    // this.$emit('person-has-updated', response.data.data);
                    // this.showSuccessPopup('更新しました');
                    // this.clearErrors();
                    this.isOpened = false;
                })
                .catch(error => {
                    // this.handleErrorStatusCode(error);
                })
                .finally(() => {
                    this.sending = false;
                });
        },
        check: function () {
            this.isChangePass = ! this.isChangePass;
        }
    }
}
</script>

<style scoped>

</style>
