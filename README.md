# Disaster Management System

A disaster management system

### Minimal Requirement

- Php 7.2 or above

- php-fpm

- mysql

- composer

- all php extension that explained in laravel minimal requirement. [https://laravel.com/docs/7.x#server-requirements](https://laravel.com/docs/7.x#server-requirements)

### Intallation Guide

For stand alone server or LAMP user:

- clone project from repository

- run `composer install` from inside project directory.

- make sure database account are ready and tested. write database configuration under .env

- run `php artisan migrate`

  

For docker user :

- clone project from repository

- run `docker-compose up`-d and wait all process finished.

- make database called `pasardb`

- duplicate `.env.example` and rename the second one to .env (config database are adjusted based on docker-compose config.

-  **important** please change value of `DOCKER_DB_LOCATION=C:\data`

- all php command will be run under docker, to doing that, follow step bellow :

- run `docker exec -it disaster-app bash`

- now you are docker bash command, now you need run command bellow:

-  `composer install`

-  `php artisan migrate`

  

all set.

  
Kuliah Industri, Teknik Informatika UMBY 2020. 
