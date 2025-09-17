<?php

namespace Yekta\LaravelAuthPackageDiscoveryFix;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\AuthManager;

class AuthPackageDiscoveryFixServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        // This package automatically fixes the issue when loaded
        // No additional registration needed
    }

    /**
     * Bootstrap the service provider.
     */
    public function boot(): void
    {
        // Apply the fix by extending the AuthManager
        $this->app->extend('auth', function (AuthManager $authManager) {
            return new class($authManager) extends AuthManager
            {
                public function __construct($originalAuthManager)
                {
                    parent::__construct($originalAuthManager->app);
                }

                protected function resolve($name)
                {
                    $config = $this->getConfig($name);

                    if (is_null($config)) {
                        throw new \InvalidArgumentException("Auth guard [{$name}] is not defined.");
                    }

                    // Apply the package discovery fix
                    if (method_exists($this->app, 'runningConsoleCommand') && $this->app->runningConsoleCommand('package:discover')) {
                        // During package discovery, return a simple mock guard to avoid dependency issues
                        return new class($name) implements \Illuminate\Contracts\Auth\Guard
                        {
                            private $name;

                            public function __construct($name)
                            {
                                $this->name = $name;
                            }

                            public function check()
                            {
                                return false;
                            }

                            public function guest()
                            {
                                return true;
                            }

                            public function user()
                            {
                                return null;
                            }

                            public function id()
                            {
                                return null;
                            }

                            public function validate(array $credentials = [])
                            {
                                return false;
                            }

                            public function setUser(\Illuminate\Contracts\Auth\Authenticatable $user)
                            {
                                return $this;
                            }

                            public function attempt(array $credentials = [], $remember = false)
                            {
                                return false;
                            }

                            public function once(array $credentials = [])
                            {
                                return false;
                            }

                            public function login(\Illuminate\Contracts\Auth\Authenticatable $user, $remember = false)
                            {
                                return $this;
                            }

                            public function loginUsingId($id, $remember = false)
                            {
                                return false;
                            }

                            public function onceUsingId($id)
                            {
                                return false;
                            }

                            public function viaRemember()
                            {
                                return false;
                            }

                            public function logout()
                            {
                                return $this;
                            }

                            public function getName()
                            {
                                return $this->name;
                            }

                            public function getRecallerName()
                            {
                                return $this->name.'_remember';
                            }

                            public function hasUser()
                            {
                                return false;
                            }
                        };
                    }

                    // Use the original resolve method for normal operation
                    return parent::resolve($name);
                }
            };
        });
    }
}