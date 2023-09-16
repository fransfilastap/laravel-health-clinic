# Laravel Health Clinic Management System
---
This is a simple healthcare management system built meant to learn how [Filamentphp](https://github.com/filamentphp)  could make laravel development easier.

In order to make my learning journey more like real project, I decided to make this project as a rewrite project.

## Built with
1. PHP 8.1
2. Laravel 10
3. Filamentphp 
4. Mysql/Mariadb

## Screenshot

<img src="https://res.cloudinary.com/dhtk5fgay/image/upload/v1694859451/Screenshot_2023-09-16_at_17.14.21_qea0k2.png" alt="login_screen">

<img src="https://res.cloudinary.com/dhtk5fgay/image/upload/v1694859451/Screenshot_2023-09-16_at_17.16.31_ypurxl.png" alt="dashboard">

## Installation

Clone the repo locally:

```
git clone https://github.com/fransfilastap/laravel-health-clinic
```

Install PHP Dependencies
```
composer install
```

Setup configuration
```
mv .env.example .env
```

Generate application key

```
php artisan key:generate
```

Run database migrations
```
php artisan migrate
```

Run database seeder

```
php artisan db:seed
```

Run role and permission configurations
```
php artisan permissions:sync
```


Please give a star if you like the project. 
