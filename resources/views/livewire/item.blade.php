@props(['video', 'propertiesView'])


<li wire:sortable.item="{{ $video->id }}" class="relative w-full	 border-b-2 ">
    @once
        <div class="border-t-2">
        </div>
    @endonce
    <div class="w-full flex  border-r-2 video">
        <div wire:sortable.handle
            class="border-box border-l border-r  bg-gray-100 bg-opacity-70 self-stretch flex-none flex flex-col items-center justify-center">
            <svg class="h-6 w-6 mx-1.5 my-auto my-auto opacity-50 " viewBox="0 0 64 64">
                <path d="M46,30H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,30.9,47.1,30,46,30z"></path>
                <path d="M46,42H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,42.9,47.1,42,46,42z"></path>
                <path d="M18,22h28c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2H18c-1.1,0-2,0.9-2,2C16,21.1,16.9,22,18,22z"></path>
            </svg>
        </div>

        <div class="w-full flex items-center m-4">


            <div class="" style=" width: 190px; height: 95px;">
                <x-video-embed :video="$video" queryString="rel=0&modestbranding" />
                <a href="{{ Artificertech\LaravelHostedVideos\Sources\Source::getVideoURL($video->source, $video->video_id) }}"
                    target="_blank"
                    class="absolute text-xs text-black transition-colors duration-300 hover:text-blue-600 ">
                    {{ Artificertech\LaravelHostedVideos\Sources\Source::getVideoURL($video->source, $video->video_id) }}
                </a>
            </div>




            @if (!empty($propertiesView))
                <div class=" flex items-center w-full">
                    <x-dynamic-component :component="$propertiesView" :video='$video' />
                </div>
            @endif

            <div dusk="remove"
                class="absolute top-0 m-3 right-0 h-5 w-5 flex items-center justify-center opacity-20 hover:opacity-50"
                wire:click="deleteHostedVideo({{ $video }})">
                <svg id="icon-remove" viewBox="0 0 64 64">
                    <path class="stroke-current stroke-1 text-gray-500" d="M43.4,40.6l-8.5-8.5l8.5-8.5c0.8-0.8,0.8-2.1,0-2.8s-2.1-0.8-2.8,0l-8.5,8.5l-8.5-8.5c-0.8-0.8-2.1-0.8-2.8,0
                    c-0.8,0.8-0.8,2.1,0,2.8l8.5,8.5l-8.5,8.5c-0.8,0.8-0.8,2.1,0,2.8c0.8,0.8,2.1,0.8,2.8,0l8.5-8.5l8.5,8.5c0.8,0.8,2.1,0.8,2.8,0
                    C44.2,42.6,44.2,41.3,43.4,40.6z"></path>
                </svg>
            </div>

        </div>
    </div>

</li>

{{-- <li wire:key="video-{{ $video->id }}" wire:sortable.item="{{ $video->id }}" class="___class_+?0___"
    id="video_{{ $video->id }}">
    @once
        <div class="border-t-2">
        </div>
    @endonce
    <div class="w-full border-b-2 flex  border-r-2 video">
        <div wire:sortable.handle
            class="border-box border-l border-r  bg-gray-100 bg-opacity-70 self-stretch flex-none flex flex-col items-center justify-center cursor-pointer">
            <svg class="h-6 w-6 mx-1.5 my-auto my-auto opacity-50 " viewBox="0 0 64 64">
                <path d="M46,30H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,30.9,47.1,30,46,30z"></path>
                <path d="M46,42H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,42.9,47.1,42,46,42z"></path>
                <path d="M18,22h28c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2H18c-1.1,0-2,0.9-2,2C16,21.1,16.9,22,18,22z"></path>
            </svg>
        </div>

        <div class=" w-full items-center m-4 ">


            <div class="w-full" style="width: 190px; height: 95px;">
                <x-video-embed :video="$video" queryString="rel=0&modestbranding" />

            </div>
            <div class="w-full transition-colors duration-300">
                <a href="{{ Artificertech\LaravelHostedVideos\Sources\Source::getVideoURL($video->source, $video->video_id) }}"
                    target="_blank" class="text-xs text-black transition-colors duration-300 hover:text-blue-600 ">
                    {{ Artificertech\LaravelHostedVideos\Sources\Source::getVideoURL($video->source, $video->video_id) }}
                </a>
            </div>
            <div class="lg:m-4  text-gray-500 w-32 flex-grow-0">
                @if ($video->source == 'Artificertech\LaravelHostedVideos\Sources\YoutubeSource')
                    Youtube

                @elseif($video->source == "Artificertech\LaravelHostedVideos\Sources\VimeoSource")
                    Vimeo
                @endif
            </div>

            <div class="text-opacity-100 flex-grow min-w-0 w-full text-xs block">
                <div class="flex text-gray-500 relative w-full">
                    Video Link
                </div>
                <div
                    class="w-full bg-gray-200 bg-opacity-60 px-2 py-1 flex-1 rounded-sm transition-colors duration-300">
                    <a href="{{ Artificertech\LaravelHostedVideos\Sources\Source::getVideoURL($video->source, $video->video_id) }}"
                        target="_blank" class="text-xs text-black transition-colors duration-300 hover:text-blue-600 ">
                        {{ Artificertech\LaravelHostedVideos\Sources\Source::getVideoURL($video->source, $video->video_id) }}
                    </a>
                </div>
            </div>

            <div dusk="remove"
                class="absolute top-0 right-0 h-5 w-5 flex items-center justify-center opacity-20 hover:opacity-50"
                wire:click="deleteHostedVideo({{ $video }})">
                <svg id="icon-remove" viewBox="0 0 64 64">
                    <path class="stroke-current stroke-1 text-gray-500" d="M43.4,40.6l-8.5-8.5l8.5-8.5c0.8-0.8,0.8-2.1,0-2.8s-2.1-0.8-2.8,0l-8.5,8.5l-8.5-8.5c-0.8-0.8-2.1-0.8-2.8,0
                    c-0.8,0.8-0.8,2.1,0,2.8l8.5,8.5l-8.5,8.5c-0.8,0.8-0.8,2.1,0,2.8c0.8,0.8,2.1,0.8,2.8,0l8.5-8.5l8.5,8.5c0.8,0.8,2.1,0.8,2.8,0
                    C44.2,42.6,44.2,41.3,43.4,40.6z"></path>
                </svg>
            </div>

        </div>
    </div>

</li> --}}
