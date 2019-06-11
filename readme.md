### WD Backend

Backend system to supply WD integration system.

### Installation

-   install dependencies `composer install`
-   run schema migration `php artisan migrate`. Make sure you've created the database before running the migration. Check your database configuration in `.env` file

### Run

-   `php -S localhost:8080 -t public`

### Tests

-   run test `vendor/bin/phpunit` - make sure you've run `composer install` before running test
