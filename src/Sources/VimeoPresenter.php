<?php

namespace Artificertech\LaravelEmbeddedVideos\Sources;

final class VimeoPresenter extends BaseVideoSource
{
    /**
     * @return string
     * @throws \Throwable
     */
    public function getEmbedCode()
    {
        return view('laravel-videoable::sources.vimeo', ['code' => $this->entity->code])->render();
    }
}
