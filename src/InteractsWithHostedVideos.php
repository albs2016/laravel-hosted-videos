<?php

namespace Artificertech\LaravelHostedVideos;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait InteractsWithHostedVideos
{
    /**
     * @return mixed
     */
    public function hostedVideos(): MorphMany
    {
        return $this->morphMany(config('hosted-videos.video_model'), 'model');
    }
}
