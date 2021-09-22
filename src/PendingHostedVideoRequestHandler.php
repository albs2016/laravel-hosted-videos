<?php

namespace Artificertech\LaravelHostedVideos;

use Artificertech\LaravelHostedVideos\Models\HostedVideo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class PendingHostedVideoRequestHandler
{

    protected Collection $hostedVideosRequestItems;

    protected Model $model;

    protected bool $preserveExisting;

    protected ?array $processCustomProperties = null;



    public function __construct($hostedVideosRequestItems, Model $model, bool $preserveExisting)
    {
        $this->hostedVideosRequestItems = $hostedVideosRequestItems;

        $this->model = $model;

        $this->preserveExisting = $preserveExisting;
    }

    public function toHostedVideos(string $collectionName = 'default')
    {
        $this->toHostedVideosCollection($collectionName);
    }

    public function withCustomProperties($customPropertyNames): self
    {
        $this->processCustomProperties = $customPropertyNames;

        return $this;
    }



    public function toHostedVideosCollection(string $collectionName = 'default')
    {

        $hostedVideosRequestItems = collect($this->hostedVideosRequestItems);
        if (!$this->preserveExisting) {
            foreach ($this->model->hostedVideos->where('collection_name', $collectionName) as $video) {
                $video->delete();
            }
        }


        if ($this->preserveExisting && $this->model->hostedVideos->where('collection_name', $collectionName)->sortby('order')->last())
            $index =  $this->model->hostedVideos->where('collection_name', $collectionName)->sortby('order')->last()->order + 1 ?? 1;
        else
            $index = 1;
        foreach ($hostedVideosRequestItems as $video) {

            $customProperties = json_decode($video->custom_properties);
            if (!is_null($this->processCustomProperties)) {
                foreach ($this->processCustomProperties as $key => $value) {
                    if (is_object($customProperties))
                        $customProperties->$key = $value;
                    else
                        $customProperties[$key] = $value;
                }
            }
            $customProperties = json_encode($customProperties);
            $this->model->hostedVideos()->save(HostedVideo::make([
                'video_id' => $video->video_id,
                'source' => $video->source ?? 'youtube', //need to change after the source issue is fixed
                'custom_properties' => $customProperties ?? '{}',
                'collection_name' => $collectionName,
                'order' => $index
            ]));
            $index += 1;
        }
        $this->model->refresh();
        return $this->model->hostedVideos->where('collection_name', $collectionName)->sortBy('order'); //if no collection is specfied it should filter by no collection specfied.

    }
}
