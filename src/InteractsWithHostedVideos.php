<?php

namespace Artificertech\LaravelHostedVideos;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Illuminate\Database\Eloquent\Collection $hostedVideos
 */
trait InteractsWithHostedVideos
{
    public function hostedVideos(): MorphMany
    {
        return $this->morphMany(config('hosted-videos.video_model'), 'model');
    }
}
