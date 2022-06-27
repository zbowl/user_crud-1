## Configure

I will be making a lot of assumptions. Hopefully with it all being included in the zip we can get it up and running with minimal steps.

- PHP 8
- Laravel 9

### Configure database in .env 

```dotenv
{
  ...
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=user_crud
    DB_USERNAME=
    DB_PASSWORD=
    ...
}
```

### Migrate and Seed the database
```shell
php artisan migrate --seed
```

### Serve the local server
```shell
php artisan serve
```

## Basic Usage

The Users CRUD is handled in a single page.

Users page: http://localhost:8000/users

The login and register pages are there for reference. There is no login scaffolding implemented

Login page: http://localhost:8000/login

Register page: http://localhost:8000/register

## Testing

There is no PHPUnit or Pest tests implemented
