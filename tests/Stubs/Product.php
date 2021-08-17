<?php

namespace Artificertech\LaravelEmbeddedVideos\tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use Artificertech\LaravelEmbeddedVideos\Traits\HasVideos;

class Product extends Model
{
    use HasVideos;

    protected $fillable = ['product_name'];
    public $timestamps = false;
}
