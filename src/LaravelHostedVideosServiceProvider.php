<?php

namespace Artificertech\LaravelHostedVideos;

use Artificertech\LaravelHostedVideos\Http\Components\HostedVideosCollectionComponent;
use Artificertech\LaravelHostedVideos\Http\Livewire\LivewireHostedVideosCollection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

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
        $this->registerLivewireComponents();

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

        Blade::component('hosted-videos-collection', HostedVideosCollectionComponent::class);
        Blade::component('hosted-videos::livewire.list', 'list');
        Blade::component('hosted-videos::livewire.item', 'item');
        Blade::component('hosted-videos::livewire.input', 'input');

        return $this;
    }

    public function registerLivewireComponents(): self
    {
        if (!class_exists(Livewire::class)) {
            return $this;
        }

        Livewire::component('livewire-hosted-videos-collection', LivewireHostedVideosCollection::class);
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
