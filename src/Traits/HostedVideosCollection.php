<?php

namespace Artificertech\LaravelHostedVideos\Traits;

use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Artificertech\LaravelHostedVideos\Sources\Source;
use Illuminate\Support\Facades\Log;

trait HostedVideosCollection
{
    public $hosted_videos;
    public $model;
    public string $collection;
    public $customProperties;

    public function addHostedVideo($url, $property)
    {
        // Log::debug($property);
        if (!empty($url) && Source::parseURL($url)) {
            [$source, $videoId] = Source::parseURL($url);
            $newVideo = new HostedVideo(['video_id' => $videoId, 'source' => $source,  'custom_properties' => json_encode((object) $this->customProperties)]);
            $newVideo->collection_name = $this->collection;
            $newVideo->custom_properties =  json_encode((object) $this->customProperties);
            $newVideo->order = !empty($this->newArray->last()->order) ? $this->newArray->last()->order + 1 : 1;
            $this->model->hostedVideos()->save($newVideo);
            $this->model->refresh();
            $this->$property = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
            $url = "";
            $this->resetErrorBag();
        } else {
            $this->addError('url', 'Please enter a valid URL.');
        }
    }

    // public function addHostedVideo($url)
    // {
    //     if (!empty($url) && Source::parseURL($url)) {
    //         [$source, $videoId] = Source::parseURL($url);
    //         $newVideo = new HostedVideo(['video_id' => $videoId, 'source' => $source,  'custom_properties' => json_encode((object) $this->customProperties)]);
    //         $newVideo->collection_name = $this->collection;
    //         $newVideo->custom_properties =  json_encode((object) $this->customProperties);
    //         $newVideo->order = !empty($this->hosted_videos->last()->order) ? $this->hosted_videos->last()->order + 1 : 1;
    //         $this->model->hostedVideos()->save($newVideo);
    //         $this->model->refresh();
    //         $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
    //         $url = "";
    //         $this->resetErrorBag();
    //     } else {
    //         $this->addError('url', 'Please enter a valid URL.');
    //     }
    // }

    public function deleteHostedVideo($video, $property)
    {
        if (!empty(HostedVideo::find($video['id'])))
            HostedVideo::find($video['id'])->delete();
        $this->model->refresh();
        $this->$property = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
    }

    public function updateHostedVideoCustomProperties($videoId, $customProperty, $value)
    {
        $updatedVideo = HostedVideo::find($videoId);
        $customProperties = json_decode($updatedVideo->custom_properties);
        if (is_object($customProperties))
            $customProperties->$customProperty = $value;
        else
            $customProperties[$customProperty] = $value;
        $updatedVideo->custom_properties = json_encode($customProperties);
        $updatedVideo->save();
    }

    // public function reorder($order)
    // {
    //     //Find video in hostedVideos array, change order, resort


    //     $i =  count($order);
    //     foreach ($order as $video) {
    //         $updatedVideo = $this->hosted_videos->where('id', $video['value']);

    //         // $updatedVideo = HostedVideo::find($video['value']);
    //         $updatedVideo->order =  $video['order'];

    //         // $updatedVideo->save();
    //         // $this->model->refresh();
    //         $i = $i - 1;
    //     }
    //     $this->model->refresh();
    //     $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
    // }

    public function reorder($order, $property = null)
    {
        // Log::debug($property);
        // Log::debug($order);
        //Find video in hostedVideos array, change order, resort


        // $i =  count($order);
        // foreach ($order as $video) {
        //     // $updatedVideo = $this->hosted_videos->where('id', $video['value']);

        //     $updatedVideo = HostedVideo::find($video['value']);
        //     $updatedVideo->order =  $video['order'];

        //     $updatedVideo->save();
        //     $this->model->refresh();
        //     $i = $i - 1;
        // }
        // $this->model->refresh();
        // $this->hosted_videos = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
    }



    public function getVideoURL($video)
    {
        return Source::getVideoURL($video->source, $video->video_id);
    }
}
