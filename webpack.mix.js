let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .extract(['vue', 'vue-cookie'])//, 'vue2-datatable-component'
    .sass('resources/assets/sass/app.scss', 'public/css');
    
//mix.scripts(['node_modules/vue2-datatable-component/dist/min.js'], 'public/js/all.js');
mix.styles(['node_modules/vue2-datatable-component/dist/min.css'], 'public/css/vue2-datatable-component.css');
    
/*mix.webpackConfig({
    module: {
        rules: [
            {
              test: /\.js$/,
              loader: 'babel-loader?cacheDirectory',
              include: [
                /node_modules\/vue2-datatable-component/,
                /vue2-datatable-component/
              ]
            }
        ]
    }
});*/