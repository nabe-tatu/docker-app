module.exports = {
    lintOnSave: false,
    runtimeCompiler: true,
    configureWebpack: {
        //Necessary to run npm link https://webpack.js.org/configuration/resolve/#resolve-symlinks
        resolve: {
            symlinks: false
        }
    },
    transpileDependencies: [
        '@coreui/utils',
        '@coreui/vue'
    ],

    //TODO:: モック作成し終えたら戻す

    outputDir: '../public/app',
    publicPath: '/app',
    pages: {
        index: {
            entry: 'src/main.js',
            template: 'public/index.html',
            filename: '../../resources/views/app.blade.php',
        }
    }
}
