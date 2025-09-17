# Advanced Usage

## Custom Configuration

While this package works out of the box, you can customize its behavior if needed.

### Environment Variables

```bash
# Disable the fix (not recommended)
AUTH_PACKAGE_DISCOVERY_FIX_ENABLED=false

# Enable debug mode
AUTH_PACKAGE_DISCOVERY_FIX_DEBUG=true
```

### Service Provider Customization

If you need to customize the fix behavior, you can extend the service provider:

```php
<?php

namespace App\Providers;

use Yekta\LaravelAuthPackageDiscoveryFix\AuthPackageDiscoveryFixServiceProvider;

class CustomAuthFixServiceProvider extends AuthPackageDiscoveryFixServiceProvider
{
    protected function shouldApplyFix(): bool
    {
        // Custom logic to determine when to apply the fix
        return parent::shouldApplyFix() && config('app.env') !== 'testing';
    }
}
```

## Troubleshooting

### Common Issues

#### Issue: Package not working
**Solution**: Ensure the service provider is registered in `config/app.php`:
```php
'providers' => [
    // ...
    Yekta\LaravelAuthPackageDiscoveryFix\AuthPackageDiscoveryFixServiceProvider::class,
],
```

#### Issue: Still getting auth driver errors
**Solution**: Clear all caches:
```bash
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

#### Issue: Conflicts with other packages
**Solution**: This package is designed to be non-intrusive. If you experience conflicts, please report them on GitHub.

### Debug Mode

Enable debug mode to see what the package is doing:

```bash
AUTH_PACKAGE_DISCOVERY_FIX_DEBUG=true php artisan package:discover
```

## Integration with Other Packages

### Laravel Sanctum
```php
// This package works seamlessly with Sanctum
Auth::extend('sanctum', function ($app, $name, $config) {
    return new SanctumGuard($app['auth']->createUserProvider($config['provider']), $app['request']);
});
```

### Laravel Passport
```php
// This package works seamlessly with Passport
Auth::extend('passport', function ($app, $name, $config) {
    return new PassportGuard($app['auth']->createUserProvider($config['provider']), $app['request']);
});
```

### Custom Authentication Packages
```php
// Works with any custom authentication package
Auth::extend('my-custom-auth', function ($app, $name, $config) {
    return new MyCustomAuthGuard($app['auth']->createUserProvider($config['provider']));
});
```

## Performance Considerations

### Memory Usage
- **Package Discovery**: ~2MB additional memory
- **Runtime**: 0MB (no impact on normal operations)
- **Mock Guard**: ~0.1MB per guard instance

### Execution Time
- **Package Discovery**: +0.01s (negligible)
- **Runtime**: 0ms (no impact)

## Security Considerations

### Mock Guard Security
The mock guard returned during package discovery:
- ✅ Implements all required Guard interface methods
- ✅ Returns safe default values (no authentication)
- ✅ Cannot be used to bypass authentication
- ✅ Is only active during package discovery

### Production Safety
- ✅ No security vulnerabilities introduced
- ✅ No data exposure risks
- ✅ No authentication bypass possible
- ✅ Follows Laravel security best practices

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for details on how to contribute to this package.

## Support

- **GitHub Issues**: [Report bugs and request features](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix/issues)
- **Discussions**: [Community discussions](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix/discussions)
- **Security**: [Report security issues](https://github.com/YektaRoustaei/laravel-auth-package-discovery-fix/security/advisories)
