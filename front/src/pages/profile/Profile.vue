<template>
    <div class="container py-3">
        <div class="row">
            <div class="col-8 mx-auto">
                <form>
                    <v-input id="profile-nickname"
                             type="text"
                             label="ニックネーム"
                             placeholder="ニックネーム">

                    </v-input>
                    <v-input id="profile-name"
                             type="text"
                             label="本名"
                             placeholder="本名">

                    </v-input>
                    <v-text-area id="profile-introduction"
                                 type="text"
                                 label="自己紹介"
                                 placeholder="自己紹介">

                    </v-text-area>
                    <v-input id="profile-mail"
                             label="メールアドレス"
                             placeholder="メールアドレス">

                    </v-input>
                    <v-file id="profile-image"
                            label="プロフィール画像">

                    </v-file>
                    <v-file id="profile-background-image"
                            label="背景画像">

                    </v-file>
                    <v-input id="profile-password"
                             type="password"
                             :disabled=isChangePass
                             label="パスワード"
                             placeholder="パスワード">

                    </v-input>
                    <v-input id="profile-password-new"
                             type="password"
                             :disabled=isChangePass
                             label="新しいパスワード"
                             placeholder="新しいパスワード">

                    </v-input>
                    <v-input id="profile-password-new"
                             type="password"
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
                               for="profile-checkbox">パスワードを変更する</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">変更を適用する</button>
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
            isChangePass: true
        }
    },
    methods: {
        check: function () {
            this.isChangePass = ! this.isChangePass;
        }
    }
}
</script>

<style scoped>

</style>
