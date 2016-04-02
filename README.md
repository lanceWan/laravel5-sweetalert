# [SweetAlert.js](http://t4t5.github.io/sweetalert/) for laravel5

## Quick Installation

Begin by installing the package through Composer.
```php
composer require lancewan/laravel-sweetalert=~1.0
```
**Or** add this code to `composer.json` file:
```php
"lancewan/laravel5-sweetalert":"~1.0"
```
Once this operation is complete, simply add both the service provider and facade classes to your project's config/app.php file:

### Service Provider
```php
Lance\Sweet\SweetAlertServiceProvider::class,
```

### Facade
```php
'Sweet' => Lance\Sweet\Facade\Sweet::class,
```

**Run** `php artisan vendor:publish`

And that's it! 

## Usage
Usage is simple. Before redirecting to another page, simply call on Flash to set your desired `Sweet` message. There are a number of methods to assign different levels of priority (info, success, warning, and error).
### Success
```php
Sweet::success($message, $title = '', $options = []);
```

### Info
```php
Sweet::info($message, $title = '', $options = []);
```

### Warning
```php
Sweet::warning($message, $title = '', $options = []);
```

### Error
```php
Sweet::error($message, $title = '', $options = []);
```

### Rendering
Just add this code to your blade template file:

```php
{!! Sweet::render() !!}
```

## Config

set the sweetAlert options in **config/sweet.php** , available options => [sweetAlert.js](http://t4t5.github.io/sweetalert/)


