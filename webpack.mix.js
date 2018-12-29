let mix = require('laravel-mix');

mix.webpackConfig({
   resolve: {
       alias: {
           'sass': path.resolve(__dirname, 'resources/assets/sass'),
           '@': path.resolve(__dirname, 'resources/assets/js')
       }
   }
})

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
