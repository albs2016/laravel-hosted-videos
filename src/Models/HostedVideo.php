<?php

namespace Artificertech\LaravelHostedVideos\Models;

use Illuminate\Database\Eloquent\Model;
use Artificertech\LaravelHostedVideos\Exceptions\VideoSourceNotFound;
use Artificertech\LaravelHostedVideos\Sources\Source;

class HostedVideo extends Model
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
     * Return a view representing the embeded video
     */
    public function embed()
    {
        return $this->source->getEmbedCode();
    }
}
