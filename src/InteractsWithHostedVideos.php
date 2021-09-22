<?php

namespace Artificertech\LaravelHostedVideos;

use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Log;

/**
 * @property Illuminate\Database\Eloquent\Collection $hostedVideos
 */
trait InteractsWithHostedVideos
{
    public function hostedVideos(): MorphMany
    {
        return $this->morphMany(config('hosted-videos.video_model'), 'model');
    }

    public function syncFromHostedVideosRequest($hostedVideosRequestItems): PendingHostedVideoRequestHandler
    {
        //Delete current videos from the collection
        //Add the new videos to the collection
        return new PendingHostedVideoRequestHandler(
            $hostedVideosRequestItems ?? [],
            $this,
            $preserveExisting = false
        );
    }

    public function addFromHostedVideosRequest($hostedVideosRequestItems): PendingHostedVideoRequestHandler
    {
        //Delete current videos from the collection
        //Add the new videos to the collection

        return new PendingHostedVideoRequestHandler(
            $hostedVideosRequestItems ?? [],
            $this,
            $preserveExisting = true
        );
    }
}
