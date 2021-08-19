<?php

namespace Artificertech\LaravelHostedVideos\Tests\Unit;

use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Artificertech\LaravelHostedVideos\Tests\Stubs\Product;
use Artificertech\LaravelHostedVideos\Tests\TestCase;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InteractsWithHostedVideosTest extends TestCase
{
    /** @test */
    public function trait_has_hosted_videos_method()
    {
        /** @var Artificertech\LaravelHostedVideos\Tests\Stubs\Product */
        $this->assertTrue(method_exists(Product::class, 'hostedVideos'));
    }

    /** @test */
    public function hosted_videos_method_returns_morph_many_object()
    {
        $this->assertInstanceOf(MorphMany::class, Product::make()->hostedVideos());
    }

    /** @test */
    public function hosted_videos_property_is_available()
    {
        try {
            Product::make()->hostedVideos;
            $this->assertTrue(true);
        } catch (\Throwable $th) {
            $this->assertTrue(false, $th->getMessage());
        }
    }
}
