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
        if (!empty($url) && Source::parseURL($url)) {
            [$source, $videoId] = Source::parseURL($url);
            $this->$property->push(
                HostedVideo::make([
                    'video_id' => $videoId,
                    'source' => $source,
                    // 'custom_properties' => json_encode((object) $this->customProperties),
                    'collection_name' => $this->collection,
                    'order' => !empty($this->$property->last()->order) ? $this->$property->last()->order + 1 : 1
                ]) //->setConnection($this->$property->first()->getConnectionName() ?? 'sqlite')
            );
        } else {
            $this->addError('url', 'Please enter a valid URL.');
        }
        // dd($this->$property);
    }



    // public function addHostedVideo($url, $property)
    // {
    //     if (!empty($url) && Source::parseURL($url)) {
    //         [$source, $videoId] = Source::parseURL($url);
    //         $newVideo = new HostedVideo(
    //             [
    //                 'video_id' => $videoId,
    //                 'source' => $source,
    //                 'custom_properties' => json_encode((object) $this->customProperties),
    //                 'collection_name' => $this->collection,
    //                 'order' => !empty($this->$property->last()->order) ? $this->$property->last()->order + 1 : 1
    //             ]
    //         );
    //         // $newVideo->setConnection($this->$property->first()->getConnectionName());
    //         $this->model->hostedVideos()->save($newVideo);
    //         $this->model->refresh();
    //         $this->$property = $this->model->hostedVideos->where('collection_name', $this->collection)->sortBy('order');
    //         $this->resetErrorBag();
    //         // dd($this->$property);
    //     } else {
    //         $this->addError('url', 'Please enter a valid URL.');
    //     }
    // }




    public function deleteHostedVideo($video, $property)
    {
        if (!empty($this->$property->firstWhere('order', $video['order']))) {
            $this->$property = $this->$property->keyBy('order')->forget($video['order']);
        }
    }

    public function updateHostedVideoCustomProperties($order, $customProperty, $value, $property)
    {
        Log::debug("message");
        $customProperties = $this->$property->firstWhere('order', $order)->custom_properties;
        // if (is_object($customProperties))
        $customProperties[$customProperty] = $value;
        // else
        //     $customProperties[$customProperty] = $value; //Only used if there are no current custom Properties
        $this->$property->firstWhere('order', $order)->custom_properties = $customProperties;
    }



    public function reorder($order)
    {
        foreach ($order as $video) {
            [$property, $index] = explode("-",  $video['value']);
            $this->$property[$index]->order = $video['order'];
        }
        $this->$property = $this->$property->sortBy('order');
    }

    public function getVideoURL($video)
    {
        return Source::getVideoURL($video->source, $video->video_id);
    }

    public function dumpArray($property)
    {
        dd($this->$property);
    }
}
