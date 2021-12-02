import Vue from 'vue';
import Vuex from 'vuex';
import { user } from './modules/user';

Vue.use(Vuex);

// TODO::Vuexを使うとバケツリレーの回避ができますが、目的をバケツリレーの回避（propsや$emitのショートカット）にするのはアンチパターンと言われています。


export default new Vuex.Store({
    //データ保持
    state: {
        users:[
            {name: 'John', email:'john@example.com', age:22},
            {name: 'Merry', email: 'merry@facebook.com',age:33},
            {name: 'Ken', email: 'ken@amazon.com',age:29}
        ],
        count: 0
    },
    //取得ロジック
    //表示用の加工処理まではやらない方が良い、コンポーネントのcomputedに任せる
    //同期処理でなければなりません
    //stateを直接参照できるが、getterから参照した方が良い
    //this.$store.state を使うと、mutation を介さずに直接 state を変更できてしまう。これは秩序が崩れるのでよくない。
    getters: {
        users : function(state){
            return state.users.filter(user => user.age < 30);
        }
    },
    //state更新
    //役割：stateの更新のみ行う、ビジネスロジックの記述はしない
    mutations: {
        increment : function(state, number) {
            state.count = state.count + number
        }
    },
    //直接更新ではなくmutationsを経由して(commit)stateを更新する
    //非同期処理でなければなりません
    //役割：stateの更新を行うビジネスロジック記述、更新はmutationに任せる
    actions: {
        incrementOne: function(context){
            context.commit('increment')
        }
    },
    //storeが大きくなったときに、別ファイルに切り分けてモジュール化
    modules: {
        user,
    }
})
