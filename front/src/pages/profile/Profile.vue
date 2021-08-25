<template>
    <div class="container py-3">
        <div class="row">
            <div class="col-8 mx-auto">
<!--                <form>-->
                    <v-input v-model="form.screen_name"
                             id="profile-nickname"
                             type="text"
                             maxlength="30"
                             label="ニックネーム"
                             placeholder="ニックネーム">

                    </v-input>
                    <v-input v-model="form.name"
                             id="profile-name"
                             type="text"
                             maxlength="30"
                             label="本名"
                             placeholder="本名">

                    </v-input>
                    <v-text-area v-model="form.introduction"
                                 id="profile-introduction"
                                 type="text"
                                 maxlength="100"
                                 label="自己紹介"
                                 placeholder="自己紹介">

                    </v-text-area>
                    <v-input v-model="form.email"
                             id="profile-mail"
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
                             :disabled=!form.isChangePass
                             label="パスワード"
                             placeholder="パスワード">

                    </v-input>
                    <v-input id="profile-password-new"
                             type="password"
                             maxlength="30"
                             :disabled=!form.isChangePass
                             label="新しいパスワード"
                             placeholder="新しいパスワード">

                    </v-input>
                    <v-input id="profile-password-new"
                             type="password"
                             maxlength="30"
                             :disabled=!form.isChangePass
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
                            @click="updateUser">
                        変更を適用する
                    </button>
<!--                </form>-->
            </div>
        </div>
    </div>
</template>

<script>
import VInput from "@/component/form/VInput";
import VTextArea from "@/component/form/VTextArea";
import VFile from "@/component/form/VFile";
import ApiRouter from "@/component/Systems/ApiRouter";
import ErrorHandler from "@/component/Systems/ErrorHandler";

export default {
    name: "Profile",
    components: {VFile, VTextArea, VInput},
    mixins: [ApiRouter, ErrorHandler],
    created: function () {
        //TODO::sleepじゃなくライフサイクルでなんとかならない？？
        setTimeout(this.addToForm, 1);
    },
    data: function () {
        return {
            id: '',
            form: {
                screen_name: '',
                name: '',
                introduction: '',
                profile_image: '',
                background_image: '',
                email: '',
                // email_verified_at: '',
                old_password: '',
                new_password: '',
                new_password_confirm: '',
                isChangePass: false
            },
        }
    },
    methods: {
        addToForm: function () {
            try
            {
                let user = this.$root.loginUser;

                console.log(user.id,'aaaaaaa');

                this.id = user.id;

                console.log(this.id,'bbbbbbbb');


                this.form.screen_name = user.attributes.screen_name;
                this.form.name = user.attributes.name;
                this.form.introduction = user.attributes.introduction;
                this.form.profile_image = user.attributes.profile_image;
                this.form.background_image = user.attributes.background_image;
                this.form.email = user.attributes.email;
            }
            catch (e)
            {
                this.showSuccessPopup('データ取得失敗');
            }
        },
        updateUser: function () {
            this.showIndicator('更新中');
            // this.sending = true;

            console.log(this.id, 1111111111111);
            console.log(this.form, 2222222222222);
            window.axios.patch(this.routes.user(this.id), this.form)
                .then(response => {
                    console.log(response, 33333333);
                    // this.$emit('person-has-updated', response.data.data);
                    this.showSuccessPopup('更新しました');
                    // this.clearErrors();
                    this.isOpened = false;
                })
                .catch(error => {
                    this.handleErrorStatusCode(error);
                })
                .finally(() => {
                    // this.sending = false;
                });
        },
        check: function () {
            this.form.isChangePass = !this.form.isChangePass;
        }
    }
}
</script>

<style scoped>

</style>
