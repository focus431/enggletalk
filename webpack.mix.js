const mix = require('laravel-mix');

// 編譯 Vue.js 和 JavaScript 文件
mix.js('resources/js/app.js', 'public/js')
   .vue({ version: 3 }) // 指定使用 Vue 3
   .js('resources/js/bootstrap.js', 'public/js');

// 處理 CSS 文件
mix.copy('node_modules/primevue/resources/themes/saga-blue/theme.css', 'public/css/saga-blue')
   .copy('node_modules/primeicons/primeicons.css', 'public/css/primeicons')
   .copy('node_modules/primeflex/primeflex.css', 'public/css');


