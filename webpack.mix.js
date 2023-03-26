const mix = require('laravel-mix');

require('laravel-mix-svelte');

mix.js('resources/js/app.js', 'public/js').svelte();
mix.js('resources/js/post.js', 'public/js').svelte();
mix.js('resources/js/tweet.js', 'public/js').svelte();

// mix.js('resources/js/app.js', 'public/js').postCss(
//     'resources/css/app.css', 'public/css', [
//       require('tailwindcss'),
//     ],
// );
// mix.js('resources/js/post.js', 'public/js').postCss(
//     'resources/css/app.css', 'public/css', [
//       require('tailwindcss'),
//     ],
// );
// mix.js('resources/js/tweet.js', 'public/js').postCss(
//     'resources/css/app.css', 'public/css', [
//       require('tailwindcss'),
//     ],
// );
