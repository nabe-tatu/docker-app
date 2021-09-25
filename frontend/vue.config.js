module.exports = {
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
