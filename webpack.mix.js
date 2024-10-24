const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
// Compile all LESS files
const lessFiles = [
    { src: 'resources/css/app.less', output: 'public/css' },
    { src: 'resources/css/admin.less', output: 'public/css/admin' },
    { src: 'resources/css/modal-back.less', output: 'public/css' },
    { src: 'resources/css/modal-front.less', output: 'public/css' }
];

lessFiles.forEach(file => {
    mix.less(file.src, file.output);
});

// Compile specific CSS files
mix.postCss('resources/css/checkbox.css', 'public/css');

// Compile JS and handle PostCSS plugins
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);