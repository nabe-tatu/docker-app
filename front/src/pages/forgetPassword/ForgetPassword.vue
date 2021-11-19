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
                                    メールアドレスを入力してください(パスワード再設定用URLを送付します)
                                </span>
                                <v-input v-model="form.email"
                                         @input="clearError('email')"
                                         :errors="hasErrors('email')"
                                         id="forget-password-email"
                                         type="text"
                                         maxlength="100"
                                         placeholder="メールアドレス">
                                </v-input>
                                <button :disabled="sending"
                                        @click="sendMail()"
                                        type="button"
                                        class="btn btn-primary float-right"
                                        >
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
    name: "ForgetPassword",
    components: {VInput},
    mixins: [ApiRouter, ErrorHandler, Utils],
    data: function () {
        return {
            form: {
                email: ''
            },
            sending: false
        }
    },
    methods: {
        sendMail: function () {
            window.axios.post(this.routes.sendResetPasswordUrl,{
                email: this.form.email
            })
                .then(response => {
                    this.showSuccessPopup('メールを送信しました');

                    this.$router.push({ name: 'Login' });
                })
                .catch(error => {
                    this.handleErrorStatusCode(error);
                })
                .finally(() => {

                });
        }
    }
}
</script>

<style scoped>

</style>
