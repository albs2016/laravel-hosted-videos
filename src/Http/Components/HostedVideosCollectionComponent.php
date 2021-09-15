<?php

namespace  Artificertech\LaravelHostedVideos\Http\Components;

use Illuminate\View\Component;

class HostedVideosCollectionComponent extends Component
{
    public $model;
    public $collection;
    public $customProperties;
    public ?string $listView;
    public ?string $itemView;
    public ?string $propertiesView;
    public ?string $inputView;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model, $collection, ?string $itemView = null, ?string $listView = null, ?string $propertiesView = null, ?string $inputView = null, $customProperties = null)
    {
        $this->model = $model;
        $this->collection =  $collection;
        $this->itemView = $itemView ?? 'item';
        $this->inputView = $inputView ?? 'input';
        $this->listView = $listView ?? 'hosted-videos::livewire.list';
        $this->propertiesView = $propertiesView ?? null;
        $this->customProperties = $customProperties ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('hosted-videos::components.hosted-videos-collection');
    }
}


//Will Nedd List View, and item view atleast.
