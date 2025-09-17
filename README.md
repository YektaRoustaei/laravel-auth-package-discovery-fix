# Laravel Auth Package Discovery Fix

A Laravel package that fixes the "Auth driver not defined" error that occurs during `composer install/update` when using custom authentication drivers.

## Problem

When using custom authentication drivers with `Auth::extend()`, you may encounter the following error during `composer install` or `composer update`:

```
Auth driver ['my-driver'] for guard [api] is not defined.
```

This error occurs during Laravel's package discovery process (`@php artisan package:discover --ansi`) when the `AuthManager` tries to resolve authentication guards before the custom drivers have been registered by their service providers.

## Solution

This package provides a fix by:

1. Detecting when the `package:discover` command is running
2. Returning a simple mock guard instead of trying to create a real guard with complex dependencies
3. Allowing the package discovery process to complete without errors
4. Maintaining normal authentication functionality outside of package discovery

## Installation

Install the package via Composer:

```bash
composer require yekta/laravel-auth-package-discovery-fix
```

The package will automatically register itself and apply the fix.

## Requirements

- PHP 8.1 or higher
- Laravel 10.x, 11.x, or 12.x

## How It Works

The package extends Laravel's `AuthManager` and overrides the `resolve()` method to detect when package discovery is running. During package discovery, it returns a simple mock guard that implements the `Guard` interface without requiring complex dependencies like session stores or request objects.

## Testing

The package includes tests to ensure it works correctly:

```bash
composer test
```

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Contributing

Please feel free to submit issues and pull requests.

## Changelog

### 1.0.0
- Initial release
- Fix for AuthManager package discovery error
- Support for Laravel 10.x, 11.x, and 12.x
