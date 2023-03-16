let mix = require('laravel-mix');
let tailwindcss = require("tailwindcss");
let postcssImport = require("postcss-import");

require('./nova.mix');

mix
  .setPublicPath('dist')
  .js('resources/js/field.js', 'js')
  .vue({ version: 3 })
  .css('resources/css/field.css', 'css', [
    postcssImport(),
    tailwindcss("tailwind.config.js"),
  ])
  .nova('marshmallow/nova-inline-select')
