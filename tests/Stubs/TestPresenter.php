<?php

namespace Artificertech\LaravelEmbeddedVideos\Tests\Stubs;

use Artificertech\LaravelEmbeddedVideos\Sources\BaseVideoSource;

class TestPresenter extends BaseVideoSource
{
    /**
     * @return string
     */
    public function getEmbedCode()
    {
        return 'My custom presenter content.';
    }
}
