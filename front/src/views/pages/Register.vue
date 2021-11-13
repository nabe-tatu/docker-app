<template>
    <div class="d-flex align-items-center min-vh-100 px-3">
        <CContainer fluid>
            <CRow class="justify-content-center py-5">
                <CCol md="8">
<!--                    <h1>プロフィール登録</h1>-->
                </CCol>
            </CRow>
            <CRow class="justify-content-center">
                <CCol md="8">
                    <CCard class="mx-4 mb-0">
                        <CCardBody class="p-4">
                            <CForm>
                                <h1 class="pb-2">Fine</h1><span class="text-muted">メールアドレスとパスワードを登録して今すぐ始めよう！</span>
<!--                                <v-input v-model="form.screen_name"-->
<!--                                         @input="clearError('screen_name')"-->
<!--                                         :errors="hasErrors('screen_name')"-->
<!--                                         id="profile-nickname"-->
<!--                                         type="text"-->
<!--                                         maxlength="30"-->
<!--                                         placeholder="ニックネーム">-->
<!--                                </v-input>-->
<!--                                <v-input v-model="form.name"-->
<!--                                         @input="clearError('name')"-->
<!--                                         :errors="hasErrors('name')"-->
<!--                                         id="profile-name"-->
<!--                                         type="text"-->
<!--                                         maxlength="30"-->
<!--                                         placeholder="本名">-->
<!--                                </v-input>-->
<!--                                <v-text-area v-model="form.introduction"-->
<!--                                             @input="clearError('introduction')"-->
<!--                                             :errors="hasErrors('introduction')"-->
<!--                                             id="profile-introduction"-->
<!--                                             type="text"-->
<!--                                             maxlength="100"-->
<!--                                             placeholder="自己紹介">-->
<!--                                </v-text-area>-->
                                <v-input v-model="form.email"
                                         @input="clearError('email')"
                                         :errors="hasErrors('email')"
                                         id="profile-mail"
                                         type="text"
                                         maxlength="100"
                                         placeholder="メールアドレス">
                                </v-input>
<!--                                <v-file @file="addToImage(-->
<!--                                            $event,-->
<!--                                            'profile_image_file',-->
<!--                                            'profile_image_url'-->
<!--                                            )"-->
<!--                                        :errors="hasErrors('profile_image')"-->
<!--                                        id="profile-image"-->
<!--                                        accept="image/*">-->
<!--                                    <template v-slot:img>-->
<!--                                        <img :src="noImageOrUrl('profile_image_url')"-->
<!--                                             alt="no image"-->
<!--                                             class="img-thumbnail"-->
<!--                                             style="max-height: 100px; max-width: 100px">-->
<!--                                    </template>-->
<!--                                </v-file>-->
<!--                                <v-file @file="addToImage(-->
<!--                                            $event,-->
<!--                                            'background_image_file',-->
<!--                                            'background_image_url'-->
<!--                                            )"-->
<!--                                        :errors="hasErrors('background_image')"-->
<!--                                        id="profile-background-image"-->
<!--                                        accept="image/*">-->
<!--                                    <template v-slot:img>-->
<!--                                        <img :src="noImageOrUrl('background_image_url')"-->
<!--                                             alt="no image"-->
<!--                                             class="img-thumbnail"-->
<!--                                             style="max-height: 100px; max-width: 100px">-->
<!--                                    </template>-->
<!--                                </v-file>-->
                                <v-input v-model="form.password"
                                         @input="clearError('password')"
                                         :errors="hasErrors('password')"
                                         id="profile-password"
                                         type="password"
                                         maxlength="30"
                                         placeholder="パスワード">
                                </v-input>
                                <v-input v-model="form.password_confirmation"
                                         @input="clearError('password_confirmation')"
                                         :errors="hasErrors('password_confirmation')"
                                         id="profile-password-new"
                                         type="password"
                                         maxlength="30"
                                         placeholder="パスワード(確認)">

                                </v-input>
                                <button :disabled=sending
                                        @click="postUser()"
                                        class="btn btn-primary float-right">
                                    登録
                                </button>
                            </CForm>
                        </CCardBody>
                    </CCard>
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>

<script>
import VInput from "@/component/form/VInput";
// import VTextArea from "@/component/form/VTextArea";
// import VFile from "@/component/form/VFile";
import ApiRouter from "@/component/Systems/ApiRouter";
import ErrorHandler from "@/component/Systems/ErrorHandler";
import Utils from "@/component/Systems/Utils";

export default {
    name: 'Register',
    mixins: [ApiRouter, ErrorHandler, Utils],
    // components: {VFile, VTextArea, VInput},
    components: {VInput},
    data: function () {
        return {
            form: {
                // screen_name: '',
                // name: '',
                // introduction: '',
                // profile_image_file: '',
                // background_image_file: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            sending: false
        }
    },
    methods: {
        postUser: function () {
            this.showIndicator('作成中');
            this.sendingTrue();

            window.axios.post(
                this.routes.register,
                this.userFormData(),
                this.userConfig()
            )
                .then(response => {
                    this.showSuccessPopup('登録完了しました');
                    setTimeout(function () {
                        this.login();
                    }.bind(this),1000);
                })
                .catch(error => {
                    this.handleErrorStatusCode(error);
                })
                .finally(() => {
                    this.sendingFalse();
                });
        },
        login: function () {
            window.axios.post('/login', {
                email: this.form.email,
                password: this.form.password
            })
                .then((response) => {
                    this.showSuccessPopup('ログインします');
                    window.location.href = '/home';
                })
                .catch((error) => {
                    this.showSuccessPopup('ログインしてください');
                    window.location.href = '/login';
                })
        },
        // addToImage: function (file, attr1, attr2) {
        //     this['form'][attr1] = file;
        //     this['form'][attr2] = URL.createObjectURL(file);
        // },
        userFormData: function () {
            const formData = new FormData();
            // formData.append('_method', 'PATCH');
            // formData.append('screen_name',this.form.screen_name);
            // formData.append('name',this.form.name);
            // formData.append('introduction',this.form.introduction);
            formData.append('email',this.form.email);
            // formData.append('profile_image_file',this.form.profile_image_file);
            // formData.append('background_image_file',this.form.background_image_file);
            formData.append('password',this.form.password);
            formData.append('password_confirmation',this.form.password_confirmation);
            return formData;
        },
        userConfig: function () {
            return {
                headers: {
                    'content-type': 'multipart/form-data',
                }
            };
        },
        // noImageOrUrl: function (attr) {
        //     return this['form'][attr] ? this['form'][attr] : this.noImage;
        // }
    }
}
</script>
