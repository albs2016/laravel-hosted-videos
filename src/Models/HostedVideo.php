<?php

namespace Artificertech\LaravelHostedVideos\Models;

use Artificertech\LaravelHostedVideos\Sources\Source;
use Artificertech\LaravelRenderable\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class HostedVideo extends Model implements Renderable
{
    protected $table = 'hosted_videos';
    protected $fillable = ['source', 'video_id', 'custom_properties'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'source' => Source::class,
    ];

    public function videoable()
    {
        return $this->morphTo();
    }

    /**
     * Get the view that represents the renderable object.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view($this->source->view());
    }

    /**
     * Defines the variable name that this renderable class
     * will have when used with the x-renderable blade component.
     *
     * @return string
     */
    public function variableName(): string
    {
        return 'video';
    }
}
