const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/location.js', 'public/js')
    .js('resources/js/select.js', 'public/js')
    .js('resources/js/questionOptions.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
