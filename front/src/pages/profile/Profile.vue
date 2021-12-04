<template>
    <div class="container py-3">
        <div class="row">
            <div class="col-8 mx-auto">
                <v-input v-model="form.screen_name"
                         @input="clearError('screen_name')"
                         :errors="hasErrors('screen_name')"
                         id="profile-nickname"
                         type="text"
                         maxlength="30"
                         label="ニックネーム"
                         placeholder="ニックネーム">
                </v-input>
                <v-input v-model="form.name"
                         @input="clearError('name')"
                         :errors="hasErrors('name')"
                         id="profile-name"
                         type="text"
                         maxlength="30"
                         label="本名"
                         placeholder="本名">
                </v-input>
                <v-text-area v-model="form.introduction"
                             @input="clearError('introduction')"
                             :errors="hasErrors('introduction')"
                             id="profile-introduction"
                             type="text"
                             maxlength="100"
                             label="自己紹介"
                             placeholder="自己紹介">
                </v-text-area>
                <v-input v-model="form.email"
                         @input="clearError('email')"
                         :errors="hasErrors('email')"
                         id="profile-mail"
                         type="text"
                         maxlength="100"
                         label="メールアドレス"
                         placeholder="メールアドレス">
                </v-input>
                <v-file @file="addToImage(
                    $event,
                    'profile_image_file',
                    'profile_image_url'
                    )"
                        :errors="hasErrors('profile_image')"
                        id="profile-image"
                        accept="image/*"
                        label="プロフィール画像">
                    <template v-slot:img>
                        <img :src="noImageOrUrl('profile_image_url')"
                             alt="no image"
                             class="img-thumbnail"
                             style="max-height: 100px; max-width: 100px">
                    </template>
                    <template v-slot:btn>
                        <button
                            @click="deleteProfile"
                            type="button"
                            class="btn btn-outline-dark btn-sm">
                            ×
                        </button>
                    </template>
                </v-file>
                <v-file @file="addToImage(
                    $event,
                    'background_image_file',
                    'background_image_url'
                    )"
                        :errors="hasErrors('background_image')"
                        id="profile-background-image"
                        accept="image/*"
                        label="背景画像">
                    <template v-slot:img>
                        <img :src="noImageOrUrl('background_image_url')"
                             alt="no image"
                             class="img-thumbnail"
                             style="max-height: 100px; max-width: 100px">
                    </template>
                    <template v-slot:btn>
                        <button
                            @click="deleteBackground"
                            type="button"
                            class="btn btn-outline-dark btn-sm">
                            ×
                        </button>
                    </template>
                </v-file>
                <v-input v-model="form.old_password"
                         @input="clearError('old_password')"
                         :disabled="! form.isChangePass"
                         :errors="hasErrors('old_password')"
                         id="profile-password"
                         type="password"
                         maxlength="30"
                         label="パスワード"
                         placeholder="パスワード">

                </v-input>
                <v-input v-model="form.new_password"
                         @input="clearError('new_password')"
                         :disabled="! form.isChangePass"
                         :errors="hasErrors('new_password')"
                         id="profile-password-new"
                         type="password"
                         maxlength="30"
                         label="新しいパスワード"
                         placeholder="新しいパスワード">

                </v-input>
                <v-input v-model="form.new_password_confirmation"
                         @input="clearError('new_password_confirmation')"
                         :disabled="! form.isChangePass"
                         :errors="hasErrors('new_password_confirmation')"
                         id="profile-password-new"
                         type="password"
                         maxlength="30"
                         label="新しいパスワード(確認用)"
                         placeholder="新しいパスワード(確認用)">

                </v-input>
                <div class="form-group form-check">
                    <input @click="check"
                           :checked="form.isChangePass"
                           id="profile-checkbox"
                           type="checkbox"
                           class="form-check-input">
                    <label class="form-check-label"
                           for="profile-checkbox">
                        パスワードを変更する
                    </label>
                </div>
                <button :disabled=sending
                        @click="updateUser"
                        class="btn btn-primary float-right">
                    変更を適用する
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import VInput from "../../component/form/VInput";
import VTextArea from "../../component/form/VTextArea";
import VFile from "../../component/form/VFile";
import ApiRouter from "../../component/Systems/ApiRouter";
import ErrorHandler from "../../component/Systems/ErrorHandler";
import Utils from "../../component/Systems/Utils";

export default {
    name: "Profile",
    components: {VFile, VTextArea, VInput},
    mixins: [ApiRouter, ErrorHandler, Utils],
    created: function () {
        //TODO::sleepじゃなくライフサイクルでなんとかならない？？
        //TODO::sleepじゃなくpromise async awaiteとか？？
        setTimeout(this.addToForm, 2000);
    },
    data: function () {
        return {
            id: '',
            form: {
                screen_name: '',
                name: '',
                introduction: '',
                profile_image_url: '',
                background_image_url: '',
                profile_image_file: '',
                background_image_file: '',
                email: '',
                // email_verified_at: '',
                old_password: '',
                new_password: '',
                new_password_confirmation: '',
                isChangePass: false,
                isDeleteProfileImg: false,
                isDeleteBackgroundImg: false
            },
            sending: false
        }
    },
    methods: {
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
                    this.clearErrors();
                })
                .catch(error => {
                    this.handleErrorStatusCode(error);
                })
                .finally(() => {
                    this.sendingFalse();
                });
        },
        addToForm: function () {
            try {
                let user = this.$store.state.authUser;
                this.id = user.id;
                this.form.screen_name = user.attributes.screen_name;
                this.form.name = user.attributes.name;
                this.form.introduction = user.attributes.introduction;
                this.form.profile_image_url = user.attributes.profile_image;
                this.form.background_image_url = user.attributes.background_image;
                this.form.email = user.attributes.email;
            } catch (e) {
                this.showSuccessPopup('データ取得失敗');
                this.$router.push({ path: '/home' });
            }
        },
        resetForm: function () {
            this.clearPass();
            this.form.isChangePass = false;
            this.form.isDeleteBackgroundImg = false;
            this.form.isDeleteProfileImg = false;
        },
        clearPass: function () {
            this.form.old_password = '';
            this.form.new_password = '';
            this.form.new_password_confirmation = '';
        },
        check: function () {
            this.form.isChangePass = ! this.form.isChangePass;
            this.clearPass();
        },
        addToImage: function (file, attr1, attr2) {
            this['form'][attr1] = file;
            this['form'][attr2] = URL.createObjectURL(file);
        },
        userFormData: function () {
            const formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('screen_name',this.form.screen_name);
            formData.append('name',this.form.name);
            formData.append('introduction',this.form.introduction);
            formData.append('email',this.form.email);
            formData.append('profile_image_file',this.form.profile_image_file);
            formData.append('background_image_file',this.form.background_image_file);
            formData.append('isDeleteProfileImg',Number(this.form.isDeleteProfileImg));
            formData.append('isDeleteBackgroundImg',Number(this.form.isDeleteBackgroundImg));
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
        deleteProfile: function () {
            this.form.profile_image_url = '';
            this.form.profile_image_file = '';
            this.form.isDeleteProfileImg = true;
        },
        deleteBackground: function () {
            this.form.background_image_file = '';
            this.form.background_image_url = '';
            this.form.isDeleteBackgroundImg = true;
        },
        noImageOrUrl: function (attr) {
            return this['form'][attr] ? this['form'][attr] : this.noImage
        },
    }
}
</script>

<style scoped>

</style>
