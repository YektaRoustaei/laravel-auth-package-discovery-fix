# API Documentation

## Service Provider

### `AuthPackageDiscoveryFixServiceProvider`

The main service provider that applies the fix to Laravel's AuthManager.

#### Methods

##### `register()`
Registers the service provider with the Laravel container.

```php
public function register(): void
```

**Description**: Automatically called by Laravel during service provider registration.

##### `boot()`
Bootstraps the service provider and applies the fix.

```php
public function boot(): void
```

**Description**: Automatically called by Laravel during service provider bootstrapping.

## Mock Guard

### `MockGuard`

A lightweight guard implementation used during package discovery.

#### Properties

##### `$name`
```php
private string $name
```

**Description**: The name of the guard instance.

#### Methods

##### `__construct($name)`
```php
public function __construct(string $name)
```

**Parameters**:
- `$name` (string): The name of the guard

**Description**: Creates a new mock guard instance.

##### `check()`
```php
public function check(): bool
```

**Returns**: `false` (always returns false for security)

**Description**: Checks if a user is authenticated.

##### `guest()`
```php
public function guest(): bool
```

**Returns**: `true` (always returns true for security)

**Description**: Checks if a user is a guest.

##### `user()`
```php
public function user(): null
```

**Returns**: `null` (always returns null for security)

**Description**: Gets the authenticated user.

##### `id()`
```php
public function id(): null
```

**Returns**: `null` (always returns null for security)

**Description**: Gets the authenticated user's ID.

##### `validate($credentials)`
```php
public function validate(array $credentials = []): bool
```

**Parameters**:
- `$credentials` (array): Authentication credentials

**Returns**: `false` (always returns false for security)

**Description**: Validates authentication credentials.

##### `setUser($user)`
```php
public function setUser(\Illuminate\Contracts\Auth\Authenticatable $user): self
```

**Parameters**:
- `$user` (Authenticatable): The user to set

**Returns**: `$this` (for method chaining)

**Description**: Sets the authenticated user.

##### `attempt($credentials, $remember)`
```php
public function attempt(array $credentials = [], $remember = false): bool
```

**Parameters**:
- `$credentials` (array): Authentication credentials
- `$remember` (bool): Whether to remember the user

**Returns**: `false` (always returns false for security)

**Description**: Attempts to authenticate a user.

##### `once($credentials)`
```php
public function once(array $credentials = []): bool
```

**Parameters**:
- `$credentials` (array): Authentication credentials

**Returns**: `false` (always returns false for security)

**Description**: Attempts to authenticate a user for a single request.

##### `login($user, $remember)`
```php
public function login(\Illuminate\Contracts\Auth\Authenticatable $user, $remember = false): self
```

**Parameters**:
- `$user` (Authenticatable): The user to login
- `$remember` (bool): Whether to remember the user

**Returns**: `$this` (for method chaining)

**Description**: Logs in a user.

##### `loginUsingId($id, $remember)`
```php
public function loginUsingId($id, $remember = false): bool
```

**Parameters**:
- `$id` (mixed): The user ID
- `$remember` (bool): Whether to remember the user

**Returns**: `false` (always returns false for security)

**Description**: Logs in a user by ID.

##### `onceUsingId($id)`
```php
public function onceUsingId($id): bool
```

**Parameters**:
- `$id` (mixed): The user ID

**Returns**: `false` (always returns false for security)

**Description**: Logs in a user by ID for a single request.

##### `viaRemember()`
```php
public function viaRemember(): bool
```

**Returns**: `false` (always returns false for security)

**Description**: Checks if the user was authenticated via remember token.

##### `logout()`
```php
public function logout(): self
```

**Returns**: `$this` (for method chaining)

**Description**: Logs out the user.

##### `getName()`
```php
public function getName(): string
```

**Returns**: The guard name

**Description**: Gets the guard name.

##### `getRecallerName()`
```php
public function getRecallerName(): string
```

**Returns**: The recaller name

**Description**: Gets the recaller name.

##### `hasUser()`
```php
public function hasUser(): bool
```

**Returns**: `false` (always returns false for security)

**Description**: Checks if a user is set.

## Configuration

### Environment Variables

#### `AUTH_PACKAGE_DISCOVERY_FIX_ENABLED`
```bash
AUTH_PACKAGE_DISCOVERY_FIX_ENABLED=true
```

**Default**: `true`

**Description**: Enables or disables the package fix.

#### `AUTH_PACKAGE_DISCOVERY_FIX_DEBUG`
```bash
AUTH_PACKAGE_DISCOVERY_FIX_DEBUG=false
```

**Default**: `false`

**Description**: Enables debug mode for troubleshooting.

## Events

### Package Discovery Started
Fired when package discovery begins and the fix is applied.

### Package Discovery Completed
Fired when package discovery completes successfully.

## Exceptions

### `AuthDriverNotDefinedException`
Thrown when an auth driver is not defined (only in normal operation, not during package discovery).

## Examples

### Basic Usage
```php
// No code needed - works automatically
composer require yekta/laravel-auth-package-discovery-fix
```

### Custom Configuration
```php
// In your .env file
AUTH_PACKAGE_DISCOVERY_FIX_ENABLED=true
AUTH_PACKAGE_DISCOVERY_FIX_DEBUG=false
```

### Debugging
```bash
# Enable debug mode
AUTH_PACKAGE_DISCOVERY_FIX_DEBUG=true php artisan package:discover
```
