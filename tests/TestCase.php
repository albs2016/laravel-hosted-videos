<?php

namespace Artificertech\LaravelHostedVideos\Tests;

use Artificertech\LaravelHostedVideos\LaravelHostedVideosServiceProvider;
use Artificertech\LaravelRenderable\LaravelRenderableServiceProvider;
use Livewire\LivewireServiceProvider;
use Livewire\Testing\TestableLivewire;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LaravelHostedVideosServiceProvider::class,
            LaravelRenderableServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', '6rE9Nz59bGRbeMATftriyQjrp4sDcOQm');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
