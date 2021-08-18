<?php

namespace Artificertech\LaravelEmbeddedVideos\tests;

use Artificertech\LaravelEmbeddedVideos\Exceptions\VideoPresenterNotFound;
use Artificertech\LaravelEmbeddedVideos\Models\Video;
use Artificertech\LaravelEmbeddedVideos\tests\Stubs\Product;
use Artificertech\LaravelEmbeddedVideos\Tests\Stubs\TestPresenter;

class VideoTest extends BaseTestCase
{
    /** @test */
    public function it_links_with_product()
    {
        $data = [
            'source' => 'test',
            'code' => '123',
            'title' => 'my video',
            'width' => 50,
            'height' => 150,
        ];

        $product = $this->createProduct();
        $product->video()->updateOrCreate(['videoable_id' => $product->id, 'videoable_type' => get_class($product)], $data);

        $this->assertInstanceOf(Video::class, $product->video);
    }

    /** @test */
    public function it_attaches_video_with_clean_method()
    {
        $product = $this->createProductWithVideo();

        $this->assertInstanceOf(Video::class, $product->video);
    }

    /** @test */
    public function it_removes_video_from_model()
    {
        $product = $this->createProductWithVideo();
        $product->removeVideo();

        $this->assertNull($product->video);
    }

    /** @test */
    public function it_generates_youtube_embed_code()
    {
        $product = $this->createProductWithVideo();

        $expected = <<<'HTML'
<div class="video">
    <iframe class="ytplayer" type="text/html" width="100%" height="100%"
            src="https://www.youtube.com/embed/123?rel=0"
            frameborder="0" allowfullscreen></iframe>
</div>

HTML;

        $this->assertEquals($expected, $product->video->getEmbed());
    }

    /** @test */
    public function it_generates_vimeo_embed_code()
    {
        $product = $this->createProductWithVideo(['source' => 'vimeo']);

        $expected = <<<'HTML'
<div class="video">
    <iframe src="https://player.vimeo.com/video/123?byline=0&portrait=0&badge=0" width="100%" height="100%"
            frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>

HTML;

        $this->assertEquals($expected, $product->video->getEmbed());
    }

    /** @test */
    public function it_throws_exception_if_source_presenter_was_not_found()
    {
        $product = $this->createProductWithVideo(['source' => 'notfound']);

        $this->expectException(VideoPresenterNotFound::class);

        $product->video->getEmbed();
    }

    /** @test */
    public function it_allows_custom_presenters_to_be_used()
    {
        include __DIR__ . '/Stubs/TestPresenter.php';
        $this->app['config']->set(
            'laravel-videoable.sources.testsource',
            TestPresenter::class
        );
        $product = $this->createProductWithVideo(['source' => 'testsource']);

        $expected = 'My custom presenter content.';
        $this->assertEquals($expected, $product->video->getEmbed());
    }

    /**
     * @param array $attributes
     * @return Product
     */
    private function createProductWithVideo(array $attributes = [])
    {
        $data = [
            'source' => 'youtube',
            'code' => '123',
            'title' => 'my video',
            'width' => 50,
            'height' => 150,
        ];

        $product = $this->createProduct();
        $product->addVideo(array_merge($data, $attributes));

        return $product;
    }
}
