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
                            label="プロフィール画像"
                            alt="no image"
                            @file="profileImage"
                            :url="form.profile_image">
                    </v-file>
                    <v-file id="profile-background-image"
                            accept="image/*"
                            label="背景画像"
                            alt="no image"
                            @file="backgroundImage"
                            :url="form.background_image">
                    </v-file>
                    <v-input v-model="form.old_password"
                             id="profile-password"
                             type="password"
                             maxlength="30"
                             :disabled=!form.isChangePass
                             label="パスワード"
                             placeholder="パスワード">

                    </v-input>
                    <v-input v-model="form.new_password"
                             id="profile-password-new"
                             type="password"
                             maxlength="30"
                             :disabled=!form.isChangePass
                             label="新しいパスワード"
                             placeholder="新しいパスワード">

                    </v-input>
                    <v-input v-model="form.new_password_confirmation"
                             id="profile-password-new"
                             type="password"
                             maxlength="30"
                             :disabled=!form.isChangePass
                             label="新しいパスワード(確認用)"
                             placeholder="新しいパスワード(確認用)">

                    </v-input>
                    <div class="form-group form-check">
                        <input @click="check"
                               :checked=form.isChangePass
                               id="profile-checkbox"
                               type="checkbox"
                               class="form-check-input">
                        <label class="form-check-label"
                               for="profile-checkbox">
                            パスワードを変更する
                        </label>
                    </div>
                    <button class="btn btn-primary float-right"
                            :disabled=sending
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
        setTimeout(this.addToForm, 2000);
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
                profile_image_file: '',
                background_image_file: '',
                email: '',
                // email_verified_at: '',
                old_password: '',
                new_password: '',
                new_password_confirmation: '',
                isChangePass: false
            },
            sending: false
        }
    },
    methods: {
        addToForm: function () {
            try
            {
                let user = this.$root.loginUser;

                this.id = user.id;
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
        resetForm: function () {
          this.form.old_password = '';
          this.form.new_password = '';
          this.form.new_password_confirmation = '';
          this.form.isChangePass = false;
        },
        updateUser: function () {
            this.showIndicator('更新中');

            this.sendingTrue();

            window.axios.post(
                this.routes.user(this.id),
                this.userFormData(),
                this.userConfig()
            )
                .then(response => {
                    this.showSuccessPopup('更新しました');
                    this.resetForm();
                })
                .catch(error => {
                    this.handleErrorStatusCode(error);
                })
                .finally(() => {
                    this.sendingFalse();
                });
        },
        check: function () {
            this.form.isChangePass = ! this.form.isChangePass;
        },
        profileImage: function (img) {
            this.form.profile_image_file = img;
        },
        backgroundImage: function (img) {
            this.form.background_image_file = img;
        },
        userFormData: function () {
            const formData = new FormData()

            formData.append('_method', 'PATCH');
            formData.append('screen_name',this.form.screen_name);
            formData.append('name',this.form.name);
            formData.append('introduction',this.form.introduction);
            formData.append('email',this.form.email);
            formData.append('profile_image_file',this.form.profile_image_file);
            formData.append('background_image_file',this.form.background_image_file);
            formData.append('old_password',this.form.old_password);
            formData.append('new_password',this.form.new_password);
            formData.append('new_password_confirmation',this.form.new_password_confirmation);
            formData.append('isChangePass',Number(this.form.isChangePass));

            return formData;
        },
        userConfig: function () {
            return {
                headers: {
                    'content-type': 'multipart/form-data',
                }
            };
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

<style scoped>

</style>
