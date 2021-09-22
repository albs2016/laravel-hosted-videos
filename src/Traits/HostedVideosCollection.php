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
                    'collection_name' => $this->collection ?? "default",
                    'order' => !empty($this->$property->last()->order) ? $this->$property->last()->order + 1 : 1
                ]) //->setConnection($this->$property->first()->getConnectionName())
                // There is an error that the setConnection would solve while adding a video. The error that source is cuasing is happening before it so I just left this code commented out
            );
        } else {
            $this->addError('url', 'Please enter a valid URL.');
        }
    }

    public function deleteHostedVideo($video, $property)
    {
        if (!empty($this->$property->firstWhere('order', $video['order']))) {
            $this->$property = $this->$property->keyBy('order')->forget($video['order']);
        }
    }

    public function updateHostedVideoCustomProperties($order, $customProperty, $value, $property)
    {
        $customProperties = $this->$property->firstWhere('order', $order)->custom_properties;
        $customProperties[$customProperty] = $value;
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
