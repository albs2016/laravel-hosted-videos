<?php

namespace  Artificertech\LaravelHostedVideos\Http\Components;

use Illuminate\View\Component;

class HostedVideosCollectionComponent extends Component
{
    public $hosted_videos;
    public $model;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
