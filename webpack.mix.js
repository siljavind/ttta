let mix = require('laravel-mix');

mix.js('src/app.js', 'dist').setPublicPath('dist');

/*mix.options({
    hmrOptions: {
        host: 'ttta.oo',
        port: '8080'
    }
})*/
