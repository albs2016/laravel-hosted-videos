<?php

namespace Artificertech\LaravelHostedVideos;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelHostedVideosServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'hosted-videos');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->registerBladeComponents();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/hosted-videos.php', 'hosted-videos');
    }

    public function registerBladeComponents(): self
    {
        Blade::component('hosted-videos::components.embed', 'video-embed');

        return $this;
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/hosted-videos.php' => config_path('hosted-videos.php'),
        ], 'hosted-videos.config');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/hosted-videos'),
        ], 'hosted-videos.views');
    }
}
