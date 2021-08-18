<?php

namespace Artificertech\LaravelHostedVideos\Sources;

use Artificertech\LaravelHostedVideos\Exceptions\VideoSourceNotFound;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Log;

class SourceCaster implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Artificertech\LaravelHostedVideos\Models\HostedVideo  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        if ($value === null) {
            return null;
        }

        if (!class_exists($value)) throw new VideoSourceNotFound($value);

        $source = new $value($model);

        return $source;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Artificertech\LaravelHostedVideos\Models\HostedVideo  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        if ($value === null) {
            return null;
        }

        if (!is_subclass_of($value, Source::class)) {
            $mapping = config('hosted-videos.sources');

            if (!isset($mapping[$value])) {
                throw new VideoSourceNotFound($value);
            }

            $value = $mapping[$value];
        }

        return $value;
    }
}
