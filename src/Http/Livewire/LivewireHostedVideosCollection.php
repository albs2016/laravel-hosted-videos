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
    public $listView;
    public $itemView;
    public $propertiesView;
    public $inputView;

    public $width;

    public function mount(string $listView = null, string $itemView = null, string $propertiesView = null, string $inputView = null)
    {
        $this->listView = $listView;
        $this->itemView = $itemView;
        $this->inputView = $inputView;
        $this->propertiesView = $propertiesView;
        $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
        $this->url = "";
        // dd($this->hosted_videos);
    }
    public function render()
    {
        return view($this->listView);
    }

    public function addHostedVideo()
    {
        if (!empty($this->url) && Source::parseURL($this->url)) {
            [$source, $videoId] = Source::parseURL($this->url);
            $newVideo = new HostedVideo(['video_id' => $videoId, 'source' => $source,  'custom_properties' => json_encode((object) $this->customProperties)]);
            $newVideo->collection_name = $this->collection;
            $newVideo->custom_properties =  json_encode((object) $this->customProperties);
            $newVideo->order = !empty($this->hosted_videos->last()->order) ? $this->hosted_videos->last()->order + 1 : 1;
            $this->model->hostedVideos()->save($newVideo);
            $this->model->refresh();
            $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
            $this->url = "";
            $this->resetErrorBag();
        } else {
            $this->addError('url', 'Please enter a valid URL.');
        }
    }

    public function deleteHostedVideo($video)
    {
        HostedVideo::find($video['id'])->delete();
        $this->model->refresh();
        $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
    }

    public function updateHostedVideoCustomProperties($video, $customProperty, $value)
    {
        Log::debug('lll');
        $updatedVideo = HostedVideo::find($video['id']);
        $customProperties = json_decode($updatedVideo->custom_properties);
        Log::debug(json_encode($customProperties));
        if (is_object($customProperties))
            $customProperties->$customProperty = $value;
        else
            $customProperties[$customProperty] = $value;
        Log::debug(json_encode($customProperties));
        $updatedVideo->custom_properties = json_encode($customProperties);
        $updatedVideo->save();
    }

    public function reorder($order)
    {
        $i =  count($order);
        foreach ($order as $video) {
            $updatedVideo = HostedVideo::find($video['value']);

            $updatedVideo->order =  $video['order'];
            $updatedVideo->save();
            $this->model->refresh();
            $i = $i - 1;
        }
        $this->model->refresh();
        $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
    }

    public function getVideoURL($video)
    {
        return Source::getVideoURL($video->source, $video->video_id);
    }
}
