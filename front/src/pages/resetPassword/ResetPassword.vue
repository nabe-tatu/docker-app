<template>
    <div class="d-flex align-items-center min-vh-100 px-3">
        <CContainer fluid>
            <CRow class="justify-content-center py-5">
                <CCol md="8">
                </CCol>
            </CRow>
            <CRow class="justify-content-center">
                <CCol md="8">
                    <CCard class="mx-4 mb-0">
                        <CCardBody class="p-4">
                            <CForm>
                                <h1 class="pb-2">
                                    Fine
                                </h1>
                                <span class="text-muted">
                                    パスワードを再設定してください
                                </span>
                                <v-input v-model="form.old_password"
                                         @input="clearError('old_password')"
                                         :errors="hasErrors('old_password')"
                                         id="profile-password"
                                         type="password"
                                         maxlength="30"
                                         placeholder="パスワード">

                                </v-input>
                                <v-input v-model="form.new_password"
                                         @input="clearError('new_password')"
                                         :errors="hasErrors('new_password')"
                                         id="profile-password-new"
                                         type="password"
                                         maxlength="30"
                                         placeholder="新しいパスワード">

                                </v-input>
                                <v-input v-model="form.new_password_confirmation"
                                         @input="clearError('new_password_confirmation')"
                                         :errors="hasErrors('new_password_confirmation')"
                                         id="profile-password-new"
                                         type="password"
                                         maxlength="30"
                                         placeholder="新しいパスワード(確認用)">

                                </v-input>
                                <button @click="changePassword()"
                                        type="button"
                                        class="btn btn-primary float-right">
                                    送信
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
import VInput from "../../component/form/VInput";
import ApiRouter from "../../component/Systems/ApiRouter";
import ErrorHandler from "../../component/Systems/ErrorHandler";
import Utils from "../../component/Systems/Utils";
export default {
    name: "ResetPassword",
    components: {VInput},
    mixins: [ApiRouter, ErrorHandler, Utils],
    created: function () {

    },
    data: function () {
        return {
            form: {
                email: this.$route.query.email,
                old_password: '',
                new_password: '',
                new_password_confirmation: '',
            },
            sending: false
        }
    },
    methods: {
        isRendering: function () {
            return true;
        },
        changePassword: function () {
            this.showIndicator('更新中');
            this.sendingTrue();

            window.axios.post(this.routes.resetPassword, this.form)
                .then(response => {
                    this.showSuccessPopup('更新しました');
                    this.clearErrors();
                    window.location.href = '/login';
                })
                .catch(error => {
                    this.handleErrorStatusCode(error);
                })
                .finally(() => {
                    this.sendingFalse();
                });
        }
    }
}
</script>

<style scoped>

</style>
