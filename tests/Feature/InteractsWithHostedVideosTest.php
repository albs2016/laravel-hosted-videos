<?php

namespace Artificertech\LaravelHostedVideos\Tests\Feature;

use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Artificertech\LaravelHostedVideos\Tests\Stubs\Product;
use Artificertech\LaravelHostedVideos\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InteractsWithHostedVideosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_links_with_product()
    {
        /** @var Artificertech\LaravelHostedVideos\Tests\Stubs\Product */
        $product = Product::create(['name' => 'my cool product']);

        $product->hostedVideos()->updateOrCreate(['source' => 'youtube', 'video_id' => 'a8sdfyas09dyfh']);

        $this->assertInstanceOf(HostedVideo::class, $product->hostedVideos()->first());
    }
}
