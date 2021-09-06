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

    public static function parseURL(string $url)
    {

        if (
            preg_match("(youtube\.com\/watch\?v=)",  $url) //embed id is between the "=" and the "&" if it exists
        ) {
            $videoId = explode("=",  $url)[1];
            $videoId = explode("&",  $videoId)[0];
            return ["youtube", $videoId];
        } else if (
            preg_match("(youtube\.com\/embed\/)", $url)  //embed id is between the "/" and before the "?" if it exists
        ) {
            $videoId = explode("embed/",  $url)[1];
            $videoId = explode("?",  $videoId)[0];
            return ["youtube", $videoId];
        } else if (
            preg_match("(youtu\.be\/)", $url) //embed id is after the "/" and before the "="
        ) {
            $videoId = explode("youtu.be/",  $url)[1];
            $videoId = explode("?",  $videoId)[0];
            return ["youtube", $videoId];
        } else if (
            preg_match("(player\.vimeo\.com\/video\/)", $url) //embed id is after the "/" and before the "="
        ) {
            $videoId = explode("player.vimeo.com/video/",  $url)[1];
            $videoId = explode("?",  $videoId)[0];
            return ["vimeo", $videoId];
        } else if (
            preg_match("(vimeo\.com\/)", $url) //embed id is after the "/" and before the "="
        ) {
            $videoId = explode("vimeo.com/",  $url)[1];
            $videoId = explode("#",  $videoId)[0];
            return ["vimeo", $videoId];
        }

        return false;
        // return "[$source, $videoId]";
    }

    // Possible YouTube URL's
    // https://www.youtube.com/watch?v=pMbEj15bmJs
    // https://youtu.be/pMbEj15bmJs
    // https://www.youtube.com/embed/pMbEj15bmJs
    // https://youtu.be/pMbEj15bmJs?t=15
    // https://www.youtube.com/watch?v=pMbEj15bmJs&t=15s
    // https://www.youtube.com/embed/pMbEj15bmJs?start=15

    // Possible Vimeo URL'S
    // https://vimeo.com/163330214
    // https://vimeo.com/163330214#t=3s
    // https://player.vimeo.com/video/163330214?h=644b5eb31c

    /**
     * @return string
     */
    abstract public function view(): string;
}
