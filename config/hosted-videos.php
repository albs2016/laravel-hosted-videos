<?php

return [

    /*
     * The fully qualified class name of the media model.
     */
    'video_model' => \Artificertech\LaravelHostedVideos\Models\HostedVideo::class,

    /*
     * Define the video sources that will be used
     */
    'sources' => [
        'youtube' => \Artificertech\LaravelHostedVideos\Sources\YoutubeSource::class,
        'vimeo' => \Artificertech\LaravelHostedVideos\Sources\VimeoSource::class,
    ],
];
