<?php

namespace Artificertech\LaravelEmbeddedVideos\Sources;

use Artificertech\LaravelEmbeddedVideos\Models\Video;

abstract class BaseVideoSource
{
    /**
     * @var \Artificertech\LaravelEmbeddedVideos\Models\Video
     */
    protected $entity;

    public function __construct(array $vars)
    {
        $this->entity = new Video(array_get($vars, 'attributes', []));
    }

    /**
     * @return string
     */
    abstract public function getEmbedCode();
}
