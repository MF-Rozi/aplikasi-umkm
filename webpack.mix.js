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
mix.copyDirectory("resources/backend/js", "public/backend/assets/js");
mix.js("resources/backend/js/backend-bootstrap.js", "public/backend/assets/js/backend.js");
mix.copyDirectory("resources/frontend/bootstrap","public/frontend/assets/bootstrap");
mix.copyDirectory("resources/frontend/css","public/frontend/assets/css");
mix.copyDirectory("resources/frontend/img","public/frontend/assets/img");
mix.copyDirectory("resources/frontend/js","public/frontend/assets/js");
mix.copyDirectory("resources/frontend/webfonts","public/frontend/assets/webfonts");
