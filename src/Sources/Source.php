<?php

namespace Artificertech\LaravelHostedVideos\Sources;

use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Illuminate\Contracts\Database\Eloquent\Castable;

abstract class Source implements Castable
{
    protected HostedVideo $model;

    public function __construct(HostedVideo $model)
    {
        $this->model = $model;
    }

    public function __toString(): string
    {
        return static::class;
    }

    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @param  array  $arguments
     * @return string
     * @return string|\Illuminate\Contracts\Database\Eloquent\CastsAttributes|\Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes
     */
    public static function castUsing(array $arguments)
    {
        return new SourceCaster;
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getEmbedCode()
    {
        return view($this->view, ['video' => $this->model]);
    }
}
