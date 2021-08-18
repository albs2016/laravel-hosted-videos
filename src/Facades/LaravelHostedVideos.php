<?php

namespace Artificertech\LaravelHostedVideos\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelHostedVideos extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-hosted-videos';
    }
}
