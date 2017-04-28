# Art Management Demo

This is a Laravel 5.4 application for managing art pieces and their associated detail images.

A "piece" can have many "detail" images.

## Installing

- Please ensure you have [Composer](https://getcomposer.org/) installed.

- You may run the following commands to install PHP and front end libraries from the project root:

`composer install`

- Make sure that your `.env` file is similar to the `.env.example` file.

- Finally, setup your database in the `.env` file and then run this command to initialize the database:

`php artisan migrate`

## Front End Assets

- Ensure you have [npm](https://www.npmjs.com/) and [Yarn](https://yarnpkg.com/en/) installed and run the following command to install the assets:

`yarn install`


- This project uses [Laravel Mix](https://github.com/JeffreyWay/laravel-mix/tree/master/docs#readme), so if you need to compile CSS or JavaScript assets you may run:

`npm run dev`

## Testing

- PHPUnit tests are included in the repository. You may run the following command from the project root to run the test suite:

`phpunit`


## License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
