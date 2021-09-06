<?php

namespace Artificertech\LaravelHostedVideos\Http\Livewire;

use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Artificertech\LaravelHostedVideos\Sources\Source;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class LivewireHostedVideosCollection extends Component
{
    public $hosted_videos;
    public $model;
    public string $collection;
    public $customProperties;
    public $url;



    protected $rules = [
        // "hosted_videos.keyby('id')[8].video_id" => 'required',
        // 'storeItem.description' => 'required|min:1',
    ];


    public function mount()
    {
        $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection);
        // $this->hosted_videos = HostedVideo::where('model', $this->model)->get();
        // ->sortBy(function ($video, $key) {
        //     return count(json_decode($video['custom_properties']));
        // });
        // $this->hosted_videos = $this->hosted_videos;;
        $this->open = false;
        $this->url = "";
        // $this->helpButton = true;
        // $item->hostedVideos()->save(new Artificertech\LaravelHostedVideos\Models\HostedVideo(['video_id' => 'dLj4BG_Di1w', 'source' => 'youtube']))
    }
    public function render()
    {
        return view('hosted-videos::livewire.livewire-hosted-videos-collection');
    }

    public function addHostedVideo()
    {
        Log::debug(Source::parseURL($this->url));
        [$source, $videoId] = Source::parseURL($this->url);
        if (!empty($this->customProperties) && is_array($this->customProperties)) {
            $newCustomeProperties = array_merge($this->customProperties, ['order' => $this->hosted_videos->count() + 1]);
            $newVideo = new HostedVideo(['video_id' => $videoId, 'source' => $source,  'custom_properties' => json_encode($newCustomeProperties)]);
            //   $this->model->hostedVideos()->save(new HostedVideo(['collection_name' => $this->collection, 'video_id' => '', 'source' => $source,  'custom_properties' => json_encode($newCustomeProperties)]));
        } else {
            // $this->model->hostedVideos()->save(new HostedVideo(['collection_name' => $this->collection, 'video_id' => '', 'source' => $source,  'custom_properties' => json_encode(['order' => $this->hosted_videos->count() + 1])]));
            $newVideo = new HostedVideo(['video_id' => $videoId, 'source' => $source,  'custom_properties' => json_encode(['order' => $this->hosted_videos->count() + 1])]);
        }
        $newVideo->collection_name = $this->collection;
        $this->model->hostedVideos()->save($newVideo);
        $this->model->refresh();
        $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection);
        $this->open = false;
    }

    public function deleteHostedVideo($video)
    {
        HostedVideo::find($video['id'])->delete();
        $this->model->refresh();
        $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection);
    }

    public function updateHostedVideo($video, $newId)
    {

        $updatedVideo = HostedVideo::find($video['id']);
        $updatedVideo->video_id = trim($newId);
        $updatedVideo->collection_name = $this->collection;
        $updatedVideo->save();
        $this->model->refresh();
        $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection);
    }

    public function updatedOrder($order)
    {
        Log::debug("updateOrder");
        $i = count($order);
        foreach ($order as $video) {
            $updatedVideo = HostedVideo::find(explode('-', $video)[1]);
            $updatedVideo->custom_properties = json_encode(['order' => $i]);
            $updatedVideo->save();
            $this->model->refresh();
            $i = $i - 1;
        }
    }
    public function updateOrder($order)
    {
        Log::debug("updateOrder");
        $i = count($order);
        foreach ($order as $video) {
            $updatedVideo = HostedVideo::find(explode('-', $video)[1]);
            // $updatedVideo =
            $updatedVideo->custom_properties = json_encode(['order' => $i]);
            $updatedVideo->save();
            $this->model->refresh();
            $i = $i - 1;
        }
    }

    public function updatedHostedVideos()
    {
        Log::debug("message");
    }
}
