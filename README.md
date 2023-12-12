<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
## instalar npm 
vendor/bin/sail npm install

## cache icones sem ele fica lento tudo
vendor/bin/sail artisan vendor:publish --tag=blade-ui-kit-config

php artisan vendor:publish --tag=blade-icons

php artisan icons:cache
