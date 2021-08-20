<?php

namespace Artificertech\LaravelHostedVideos\Sources;

class VimeoSource extends Source
{
    public function view(): string
    {
        return 'hosted-videos::sources.vimeo';
    }
}
