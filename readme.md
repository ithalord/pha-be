# Event Management System with RFID/Bar Code/QR Code Interrogation - Backend

Clone or Fork


## Requirments
-Laravel 5.6.
-PHP >= 7.1.3.

## How to
-composer install.
-check out latest branch `[check here]`(https://bitbucket.org/harold_pascual/pha-be/commits/all).
-composer update.
-cp .env.example .env.
-edit .env `dbname, username, password`.
-php artisan migrate --seed.
-php artisan key:generate.
-php artisan serve.

### see
authentication - `database > seeds > UserTableSeeder.php`.
routes - `routes > api.php`.
