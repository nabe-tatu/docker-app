<template>
    <div class="c-app flex-row align-items-center">
        <CContainer>
            <CRow class="justify-content-center">
                <CCol md="8">
                    <CCardGroup>
                        <CCard class="p-4">
                            <CCardBody>
                                <CForm>
                                    <h1>Fine</h1>
<!--                                    <p class="text-muted">Sign In to your account</p>-->
                                    <CInput
                                        v-model="form.email"
                                        placeholder="メールアドレス"
                                        autocomplete="username email">
                                        <template #prepend-content>
                                            <CIcon name="cil-user"/>
                                        </template>
                                    </CInput>
                                    <CInput
                                        v-model="form.password"
                                        placeholder="パスワード"
                                        type="password"
                                        autocomplete="curent-password">
                                        <template #prepend-content>
                                            <CIcon name="cil-lock-locked"/>
                                        </template>
                                    </CInput>
                                    <CRow>
                                        <CCol col="6" class="text-left">
                                            <CButton color="primary" class="px-4" @click="login">ログイン</CButton>
                                        </CCol>
                                        <CCol col="6" class="text-right">
                                            <CButton @click="toForgetPassword()"
                                                     color="link"
                                                     class="px-0">
                                                パスワードをお忘れの方はこちら
                                            </CButton>
                                            <CButton @click="toRegister()"
                                                     color="link"
                                                     class="d-lg-none">
                                                登録がまだの方はこちら
                                            </CButton>
                                        </CCol>
                                    </CRow>
                                </CForm>
                            </CCardBody>
                        </CCard>
                        <CCard
                            color="primary"
                            text-color="white"
                            class="text-center py-5 d-md-down-none"
                            body-wrapperp>
                            <CCardBody>
<!--                                <h2>Sign up</h2>-->
                                <p>
                                    登録は簡単
                                    <br><br>メールアドレスと<br>パスワードを入力するだけ
                                    <br><br>さあ、お勉強を始めよう！
                                </p>
                                <CButton
                                    @click="toRegister()"
                                    color="light"
                                    variant="outline"
                                    size="lg">
                                    登録する
                                </CButton>
                            </CCardBody>
                        </CCard>
                    </CCardGroup>
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>

<script>
import ErrorHandler from "@/component/Systems/ErrorHandler";

export default {
    name: 'Login',
    mixins: [ErrorHandler],
    data: function () {
        return {
            form: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login: function () {
            window.axios.post('/login', this.form)
                .then((response) => {
                    window.location.href = '/home';
                })
                .catch((error) => {
                    this.inputErrorHandle(error);
                })
        },
        toRegister: function () {
            this.$router.push({ name: 'Register'});
        },
        toForgetPassword: function () {
            this.$router.push({ name: 'ForgetPassword'});
        }
    }
}
</script>
