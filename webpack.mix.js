let mix = require("laravel-mix");
let path = require("path");
let tailwindcss = require("tailwindcss");
let postcssImport = require("postcss-import");
let NovaExtension = require("laravel-nova-devtool");

mix.extend("nova", new NovaExtension());

mix.alias({
    "laravel-nova$": path.join(
        __dirname,
        "vendor/laravel/nova/resources/js/mixins/packages.js"
    ),
    "@": path.join(__dirname, "vendor/laravel/nova/resources/js"),
});

mix.setPublicPath("dist")
    .js("resources/js/field.js", "js")
    .vue({ version: 3 })
    .css("resources/css/field.css", "css", [
        postcssImport(),
        tailwindcss("tailwind.config.js"),
    ])
    .nova("marshmallow/nova-inline-select");
