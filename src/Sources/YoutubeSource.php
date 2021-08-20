<?php

namespace Artificertech\LaravelHostedVideos\Sources;

class YoutubeSource extends Source
{
    public function view(): string
    {
        return 'hosted-videos::sources.youtube';
    }
}
