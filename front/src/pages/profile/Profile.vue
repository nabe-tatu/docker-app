<template>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ニックネーム</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="ニックネーム">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">本名</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="本名">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">自己紹介</label>
                        <textarea class="form-control" id="validationTextarea" placeholder="自己紹介"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">メールアドレス</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="メールアドレス">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">プロフィール画像</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">背景画像</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>


                    <div class="form-group pt-5">
                        <label for="exampleInputPassword1">現在のパスワード</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="現在のパスワード">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">新しいパスワード</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="新しいパスワード">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">新しいパスワード(確認)</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="新しいパスワード(確認)">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">パスワードを変更する</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">変更を適用する</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile"
}
</script>

<style scoped>

</style>
