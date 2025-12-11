@echo off
REM Script batch pour utiliser Artisan avec PHP 7.4.33
REM Utilisation: artisan_php74.bat key:generate
REM            : artisan_php74.bat migrate
REM            : artisan_php74.bat serve

C:\wamp64\bin\php\php7.4.33\php.exe artisan %*

