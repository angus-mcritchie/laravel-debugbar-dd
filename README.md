# laravel-debugbar-dd
Ever wanted to `dd()` and see the debugbar? This package does just that by calling `bd()` - Bar Dump.

## Installation
`composer require gooby/laravel-debugbar-dd --dev`

## Usage
- `bd($var1, $var2, ...)` - will dump the variables and show the debugbar
- `bd()` - will show the debugbar

## Example
```php
Route::get('/', function () {
    $user = App\User::first();
    bd($user);
});
```

![Example](https://raw.githubusercontent.com/angus-mcritchie/laravel-debugbar-dd/master/resources/example.png)


## Credits
- [laravel-debugbar](https://packagist.org/packages/barryvdh/laravel-debugbar) by barryvdh
- [symfony/var-dumper](https://packagist.org/packages/symfony/var-dumper) by symfony
- [laravel/framework](https://packagist.org/packages/laravel/framework) by taylorotwell
