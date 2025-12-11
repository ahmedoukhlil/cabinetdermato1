@echo off
REM Script batch pour utiliser Composer avec PHP 7.4.33
REM Utilisation: composer_php74.bat install
REM            : composer_php74.bat update
REM            : composer_php74.bat require package/name

C:\wamp64\bin\php\php7.4.33\php.exe C:\composer\composer.phar %*

