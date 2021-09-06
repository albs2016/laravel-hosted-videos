<li class="w-full border-b-2 flex  border-r-2 video" id="video-{{ $video->id }}">

    <div
        class="border-box border-l border-r  bg-gray-100 bg-opacity-70 self-stretch flex-none flex flex-col items-center justify-center">
        <svg class="h-6 w-6 mx-1.5 my-auto my-auto opacity-50 " viewBox="0 0 64 64">
            <path d="M46,30H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,30.9,47.1,30,46,30z"></path>
            <path d="M46,42H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,42.9,47.1,42,46,42z"></path>
            <path d="M18,22h28c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2H18c-1.1,0-2,0.9-2,2C16,21.1,16.9,22,18,22z"></path>
        </svg>
    </div>

    <div class="relative w-full flex items-center m-4 ">


        <div class="___class_+?4___" style="width: 250px; height: 95px;">
            <x-video-embed :video="$video" queryString="rel=0&modestbranding" />
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
                Video Id
                {{-- <div class="relative mb-1" x-data="{ open: false }" @mouseleave="open = false"
                    x-init="console.log(open)">
                    <div @mouseover="open = true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 " fill="currentColor"
                            viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                        </svg>
                    </div>
                    <div x-show="open" class="absolute bottom-0 flex flex-col items-center mb-6 ">
                        <span
                            class=" bottom-0 z-10 p-2 text-xs leading-none text-white whitespace-no-wrap bg-gray-400 shadow-lg rounded-md ">
                            Please insert the YouTube video embed ID here. It is a group of
                            characters
                            that can
                            be
                            found on the URL of the YouTube video after the equals sign.<br> For
                            example
                            on this
                            YouTube video URL "https://www.youtube.com/watch?v=B7Lo7aAZhVk" the
                            embed ID
                            would
                            be
                            everything after the equals sign which is, "B7Lo7aAZhVk".
                        </span>
                    </div>
                </div> --}}
            </div>
            <input
                class="w-full bg-gray-200 bg-opacity-60 px-2 py-1 flex-1 text-xs rounded-sm transition-colors duration-300"
                value="{{ $video->video_id }}" name="video-{{ $video->id }}"
                x-on:keyup.debounce="$wire.updateHostedVideo({{ $video }}, document.getElementsByName('video-{{ $video->id }}')[0].value )" />
        </div>

        <div dusk="remove"
            class="absolute top-0 right-0 h-5 w-5 flex items-center justify-center opacity-20 hover:opacity-50"
            wire:click="deleteHostedVideo({{ $video }})" style="">
            <svg id="icon-remove" viewBox="0 0 64 64">
                <path class="stroke-current stroke-1 text-gray-500" d="M43.4,40.6l-8.5-8.5l8.5-8.5c0.8-0.8,0.8-2.1,0-2.8s-2.1-0.8-2.8,0l-8.5,8.5l-8.5-8.5c-0.8-0.8-2.1-0.8-2.8,0
                    c-0.8,0.8-0.8,2.1,0,2.8l8.5,8.5l-8.5,8.5c-0.8,0.8-0.8,2.1,0,2.8c0.8,0.8,2.1,0.8,2.8,0l8.5-8.5l8.5,8.5c0.8,0.8,2.1,0.8,2.8,0
                    C44.2,42.6,44.2,41.3,43.4,40.6z"></path>
            </svg>
        </div>

    </div>
</li>
