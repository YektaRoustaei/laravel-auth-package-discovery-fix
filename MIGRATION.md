# Migration Guide

## From Manual Fixes

If you've been manually fixing the "Auth driver not defined" error, this package will replace your manual work.

### Before (Manual Fix)
```php
// In your AppServiceProvider
public function boot()
{
    if (app()->runningInConsole() && app()->runningCommand('package:discover')) {
        // Manual workaround
        Auth::extend('temp-driver', function ($app, $name, $config) {
            return new SessionGuard($name, $app['auth']->createUserProvider($config['provider']), $app['session.store']);
        });
    }
}
```

### After (With This Package)
```php
// Just install the package - no code needed!
composer require yekta/laravel-auth-package-discovery-fix
```

## From Other Packages

### Replacing Laravel Framework Patches
If you've been patching Laravel core files:

1. **Remove your patches**
2. **Install this package**: `composer require yekta/laravel-auth-package-discovery-fix`
3. **Test your application**

### Replacing Custom Service Providers
If you have a custom service provider doing similar work:

1. **Remove your custom service provider**
2. **Install this package**: `composer require yekta/laravel-auth-package-discovery-fix`
3. **Remove your custom code**

## Version Migration

### From 0.x to 1.x
No breaking changes - this is the first stable release.

### Future Versions
We follow semantic versioning:
- **Major versions** (2.0, 3.0): May contain breaking changes
- **Minor versions** (1.1, 1.2): New features, backward compatible
- **Patch versions** (1.0.1, 1.0.2): Bug fixes, backward compatible

## Rollback

If you need to rollback:

```bash
# Remove the package
composer remove yekta/laravel-auth-package-discovery-fix

# Clear caches
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

## Troubleshooting Migration

### Issue: Package not working after installation
**Solution**: Ensure the service provider is auto-registered:
```bash
composer dump-autoload
php artisan config:clear
```

### Issue: Conflicts with existing code
**Solution**: This package is designed to be non-intrusive. If you experience conflicts:
1. Check your `config/app.php` for duplicate service providers
2. Clear all caches
3. Report the issue on GitHub

### Issue: Still getting auth driver errors
**Solution**: 
1. Verify the package is installed: `composer show yekta/laravel-auth-package-discovery-fix`
2. Check Laravel version compatibility
3. Clear all caches
4. Test with a fresh Laravel installation

## Best Practices

### After Migration
1. **Test thoroughly** - Run your full test suite
2. **Monitor performance** - Check for any performance impact
3. **Update documentation** - Update your project's README
4. **Remove old code** - Clean up any manual fixes

### Maintenance
1. **Keep updated** - Regularly update to the latest version
2. **Monitor issues** - Watch for GitHub issues and updates
3. **Report problems** - Help improve the package by reporting issues

## Getting Help

If you encounter issues during migration:

- **GitHub Issues**: [Report migration problems](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix/issues)
- **Discussions**: [Ask questions](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix/discussions)
- **Documentation**: Check the [README](README.md) and [FAQ](FAQ.md)
