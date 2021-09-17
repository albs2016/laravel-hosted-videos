<?php

namespace Artificertech\LaravelHostedVideos\Tests\Feature;


use Artificertech\LaravelHostedVideos\Http\Livewire\HostedVideosCollection;
use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Artificertech\LaravelHostedVideos\Tests\Stubs\Product;
use Artificertech\LaravelHostedVideos\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\HtmlString;

class HostedVideosCollectionTest extends TestCase
{
    use RefreshDatabase;
    use InteractsWithViews;


    /** @test */
    public function test_hosted_videos_collection_can_render()
    {
        $product = Product::create(['name' => 'my cool product']);
        $product->hostedVideos()->save(new HostedVideo(['video_id' => 'dLj4BG_Di1w', 'source' => 'youtube']));
        $livewireTest = Livewire::test(HostedVideosCollection::class, ['model' => $product, 'listView' => 'hosted-videos::livewire.list', 'inputView' => 'input', 'itemView' => 'item', 'collection' => "draft"]);
        $livewireTest->assertStatus(200);
    }

    public function test_add_video()
    {
        $product = Product::create(['name' => 'my cool product']);
        $product->hostedVideos()->save(new HostedVideo(['video_id' => 'dLj4BG_Di1w', 'source' => 'youtube']));
        $livewireTest = Livewire::test(HostedVideosCollection::class, ['model' => $product, 'listView' => 'hosted-videos::livewire.list', 'inputView' => 'input', 'itemView' => 'item', 'collection' => "draft"]);
        $livewireTest->call('addHostedVideo')->assertHasErrors('url');
        $livewireTest->set('url', 'notvalid.com')->call('addHostedVideo')->assertHasErrors('url');
        $livewireTest->set('url', 'https://www.youtube.com/watch?v=kC86TtdeuDc')->call('addHostedVideo')->assertHasNoErrors('url');
        $livewireTest->set('url', 'https://vimeo.com/163330214')->call('addHostedVideo')->assertHasNoErrors('url');
        $livewireTest->assertCount('hosted_videos', 2);
    }

    public function test_delete_video()
    {
        $product = Product::create(['name' => 'my cool product']);
        $product->hostedVideos()->save(new HostedVideo(['video_id' => 'dLj4BG_Di1w', 'source' => 'youtube']));
        $livewireTest = Livewire::test(HostedVideosCollection::class, ['model' => $product, 'listView' => 'hosted-videos::livewire.list', 'inputView' => 'input', 'itemView' => 'item', 'collection' => "draft"]);
        $video['id'] = 2;
        $livewireTest->call('deleteHostedVideo', $video);
        $livewireTest->assertCount('hosted_videos', 0);
        $livewireTest->set('url', 'https://www.youtube.com/watch?v=kC86TtdeuDc')->call('addHostedVideo')->assertHasNoErrors('url');
        $livewireTest->set('url', 'https://vimeo.com/163330214')->call('addHostedVideo')->assertHasNoErrors('url');
        $video['id'] = 2;
        $livewireTest->call('deleteHostedVideo', $video);
        $livewireTest->assertCount('hosted_videos', 1);
    }

    public function test_reorder_video()
    {
        $product = Product::create(['name' => 'my cool product']);
        $product->hostedVideos()->save(new HostedVideo(['video_id' => 'dLj4BG_Di1w', 'source' => 'youtube']));
        $livewireTest = Livewire::test(HostedVideosCollection::class, ['model' => $product, 'listView' => 'hosted-videos::livewire.list', 'inputView' => 'input', 'itemView' => 'item', 'collection' => "draft"]);
        $livewireTest->call('addHostedVideo');
        $livewireTest->set('url', 'https://www.youtube.com/watch?v=11111111')->call('addHostedVideo');
        $livewireTest->set('url', 'https://www.youtube.com/watch?v=22222222')->call('addHostedVideo');
        $livewireTest->set('url', 'https://vimeo.com/33333333')->call('addHostedVideo');
        $this->assertEquals('2', $livewireTest->hosted_videos->first()->id);
        $livewireTest->call('reorder', [['order' => '3', 'value' => '2'], ['order' => '2', 'value' => '3'], ['order' => '1', 'value' => '4']]);
        $this->assertEquals('4', $livewireTest->hosted_videos->first()->id);
    }

    public function test_updateHostedVideoCustomProperties()
    {
        $product = Product::create(['name' => 'my cool product']);
        $product->hostedVideos()->save(new HostedVideo(['video_id' => 'dLj4BG_Di1w', 'source' => 'youtube']));
        $livewireTest = Livewire::test(HostedVideosCollection::class, ['model' => $product, 'listView' => 'hosted-videos::livewire.list', 'inputView' => 'input', 'itemView' => 'item', 'collection' => "draft", 'customProperties' => ['testing' => true]]);
        $livewireTest->call('addHostedVideo');
        $livewireTest->set('url', 'https://www.youtube.com/watch?v=11111111')->call('addHostedVideo');
        $livewireTest->set('url', 'https://www.youtube.com/watch?v=22222222')->call('addHostedVideo');
        $livewireTest->set('url', 'https://vimeo.com/33333333')->call('addHostedVideo');
        $this->assertEquals(true, json_decode($livewireTest->hosted_videos->first()->custom_properties)->testing);
        $livewireTest->call('updateHostedVideoCustomProperties', $livewireTest->hosted_videos->first()->id, 'newProperty', 'set');
        $livewireTest->hosted_videos->first()->refresh();
        $this->assertEquals('set', json_decode($livewireTest->hosted_videos->first()->custom_properties)->newProperty);
    }

    public function test_item_component_can_be_rendered()
    {
        $view = $this->blade(
            '<x-item :video="$video" :propertiesView="$propertiesView" :url="$url" :index="$index"/>',
            ['video' =>  new HostedVideo(['source' =>  'Artificertech\LaravelHostedVideos\Sources\YoutubeSource', 'videoId' => '3AQ-cjOS9tY']), 'propertiesView' => null, 'url' => 'https://www.youtube.com/watch?v=3AQ-cjOS9tY', 'index' => 0]
        );

        $view->assertSee('https://www.youtube.com/watch?v=3AQ-cjOS9tY');
    }

    public function test_input_component_can_be_rendered()
    {
        $view = $this->withViewErrors([
            'url' => ['Please provide a valid URL.']
        ])->blade(
            '<x-input  :url="$url"/>',
            ['url' => 'https://www.youtube.com/watch?v=3AQ-cjOS9tY', 'index' => 0, 'errors' => ['url' => ['Please provide a valid URL.']]]
        );

        $view->assertSee('Please enter the URL of the video here.');
    }

    public function test_livewireCustomPropertyAttributes()
    {
        $product = Product::create(['name' => 'my cool product']);
        $product->hostedVideos()->save(new HostedVideo(['video_id' => 'dLj4BG_Di1w', 'source' => 'youtube']));
        $livewireTest = Livewire::test(HostedVideosCollection::class, ['model' => $product, 'listView' => 'hosted-videos::livewire.list', 'inputView' => 'input', 'itemView' => 'item', 'collection' => "draft", 'customProperties' => ['testing' => true]]);
        $livewireTest->call('addHostedVideo');
        $livewireTest->set('url', 'https://www.youtube.com/watch?v=11111111')->call('addHostedVideo');
        $this->assertEquals(new HtmlString(implode(PHP_EOL, [
            'x-data=""',
            "name='video-2-test'",
            "value=''",
            "x-on:keyup.debounce=\"\$wire.updateHostedVideoCustomProperties(2,'test',document.getElementsByName('video-2-test')[0].value)\"",

        ])), $livewireTest->hosted_videos->first()->livewireCustomPropertyAttributes('test'));
    }
}
