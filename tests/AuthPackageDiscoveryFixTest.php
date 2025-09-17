<?php

namespace Yekta\LaravelAuthPackageDiscoveryFix\Tests;

use Orchestra\Testbench\TestCase;
use Yekta\LaravelAuthPackageDiscoveryFix\AuthPackageDiscoveryFixServiceProvider;

class AuthPackageDiscoveryFixTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            AuthPackageDiscoveryFixServiceProvider::class,
        ];
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Reset the application state
        unset($_SERVER['argv']);
    }

    public function testAuthManagerDoesNotThrowErrorDuringPackageDiscovery()
    {
        $_SERVER['argv'] = ['artisan', 'package:discover'];

        $this->app['config']->set('auth', [
            'defaults' => ['guard' => 'api'],
            'guards' => [
                'api' => [
                    'driver' => 'my-custom-driver',
                    'provider' => 'users',
                ],
            ],
            'providers' => [
                'users' => [
                    'driver' => 'eloquent',
                    'model' => \Illuminate\Tests\Auth\TestUser::class,
                ],
            ],
        ]);

        $authManager = $this->app['auth'];

        // This should not throw an error during package discovery
        $guard = $authManager->guard('api');

        $this->assertInstanceOf(\Illuminate\Contracts\Auth\Guard::class, $guard);
    }

    public function testAuthManagerWorksNormallyOutsidePackageDiscovery()
    {
        $_SERVER['argv'] = ['artisan', 'migrate'];

        $this->app['config']->set('auth', [
            'defaults' => ['guard' => 'api'],
            'guards' => [
                'api' => [
                    'driver' => 'session',
                    'provider' => 'users',
                ],
            ],
            'providers' => [
                'users' => [
                    'driver' => 'eloquent',
                    'model' => \Illuminate\Tests\Auth\TestUser::class,
                ],
            ],
        ]);

        $authManager = $this->app['auth'];
        $guard = $authManager->guard('api');

        $this->assertInstanceOf(\Illuminate\Contracts\Auth\Guard::class, $guard);
    }
}

class TestUser extends \Illuminate\Foundation\Auth\User
{
    protected $fillable = ['name', 'email', 'password'];
}
