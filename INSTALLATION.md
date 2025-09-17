# Installation Guide

## Quick Start

1. **Install the package:**
   ```bash
   composer require yekta/laravel-auth-package-discovery-fix
   ```

2. **That's it!** The package automatically registers itself and applies the fix.

## How to Use

The package works automatically once installed. No configuration is needed.

### What it fixes:

- **Before:** `composer install/update` fails with "Auth driver not defined" error
- **After:** `composer install/update` works smoothly with custom auth drivers

### Example Usage:

```php
// In your Laravel application, you can use custom auth drivers normally:

// In a service provider
Auth::extend('my-custom-driver', function ($app, $name, $config) {
    return new MyCustomGuard($name, $app['auth']->createUserProvider($config['provider']));
});

// In config/auth.php
'guards' => [
    'api' => [
        'driver' => 'my-custom-driver',
        'provider' => 'users',
    ],
],
```

## Testing

Run the package tests:

```bash
composer test
```

## Uninstalling

```bash
composer remove yekta/laravel-auth-package-discovery-fix
```

## Support

- **Laravel Versions:** 10.x, 11.x, 12.x
- **PHP Versions:** 8.1+
- **Issues:** Please report issues on GitHub
