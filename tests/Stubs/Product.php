<?php

namespace Artificertech\LaravelHostedVideos\Tests\Stubs;

use Artificertech\LaravelHostedVideos\InteractsWithHostedVideos;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use InteractsWithHostedVideos;

    protected $fillable = ['name'];
}
