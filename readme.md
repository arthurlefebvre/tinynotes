# TinyNotes

A small projet to discuss with your friends via post-it like messages.

Example:
![alt text](public/tinynotes.png 'Post-it message example screenshot')

Uses Laravel 5.8

## Installation

(requires composer and npm) <br>

-   Install Php dependencies:
    `composer install` <br>
-   Install Javascript dependencies :
    `npm install`
-   Update your database tables :
    `php artisan migrate`
-   Create a .env file with your database configuration (see https://github.com/laravel/laravel/blob/master/.env.example) at the root of the project.
-   Generate your application key :
    `php artisan key:generate`
-   Run your local server :
    `php artisan serve`
