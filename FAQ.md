# Frequently Asked Questions

## General Questions

### Q: What does this package do?
A: This package fixes the "Auth driver not defined" error that occurs during `composer install/update` when using custom authentication drivers in Laravel.

### Q: Do I need to configure anything?
A: No! The package works automatically after installation. Just run `composer require yekta/laravel-auth-package-discovery-fix` and it will start working.

### Q: Will this affect my application's performance?
A: No, this package only activates during the `package:discover` command and has zero impact on your application's runtime performance.

## Installation & Usage

### Q: Which Laravel versions are supported?
A: Laravel 10.x, 11.x, and 12.x are supported.

### Q: Which PHP versions are supported?
A: PHP 8.1 and higher.

### Q: How do I know if I need this package?
A: If you're getting "Auth driver not defined" errors during `composer install/update` with custom auth drivers, this package will fix it.

## Troubleshooting

### Q: The package isn't working, what should I do?
A: 
1. Make sure you're using a supported Laravel version
2. Check that the package is properly installed: `composer show yekta/laravel-auth-package-discovery-fix`
3. Clear your composer cache: `composer clear-cache`
4. Check the [GitHub issues](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix/issues) for similar problems

### Q: Can I use this with other auth packages?
A: Yes, this package is designed to work alongside other authentication packages without conflicts.

### Q: Does this work with Laravel Sanctum/Passport?
A: Yes, this package works with any custom authentication driver, including Sanctum and Passport.

## Technical Questions

### Q: How does the fix work?
A: The package detects when the `package:discover` command is running and returns a simple mock guard instead of trying to create a real guard with complex dependencies.

### Q: Is this safe to use in production?
A: Yes, this package is production-ready and has been tested across multiple Laravel versions.

### Q: Can I see the source code?
A: Yes, the source code is available on [GitHub](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix).

## Support

### Q: Where can I get help?
A: 
- Check the [GitHub issues](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix/issues)
- Create a new issue if your problem isn't already reported
- Check the [Laravel documentation](https://laravel.com/docs) for general Laravel questions

### Q: Can I contribute to this package?
A: Yes! Please see our [Contributing Guide](CONTRIBUTING.md) for details.
