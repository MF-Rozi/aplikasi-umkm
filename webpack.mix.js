const mix = require("laravel-mix");

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
mix.copyDirectory("resources/backend/fonts", "public/backend/assets/fonts");
mix.styles(
    [
        "resources/backend/css/nucleo-icons.css",
        "resources/backend/css/nucleo-svg.css",
        "resources/backend/css/soft-ui-dashboard.css",
    ],
    "public/backend/assets/css/backend.css"
);
mix.copyDirectory("resources/backend/js", "public/backend/assets/js"

);
