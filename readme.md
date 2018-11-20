## Demo using Laravel with Backpack framework.


## Installation

- run composer:
```
composer install
```

- create the database (on MySQL):
```
create database inmobiliaria
```
- run composer ( [here why](https://stackoverflow.com/questions/33973967/why-do-i-have-to-run-composer-dump-autoload-command-to-make-migrations-work-in) )
```
composer dump-autoload
``` 

- run the migrations:
```
php artisan migrate
```

- run seed
```
php artisan db:seed --class=DatabaseSeeder
``` 

