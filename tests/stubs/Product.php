<?php

namespace Artificertech\LaravelHostedVideos\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Artificertech\LaravelHostedVideos\InteractsWithHostedVideos;

class Product extends Model
{
    use InteractsWithHostedVideos;

    protected $fillable = ['product_name'];
    public $timestamps = false;
}
