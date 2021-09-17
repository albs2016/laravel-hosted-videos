@props(['video', 'url', 'propertiesView', 'index'])
<li wire:sortable.item="{{ $video->id }}" class="relative w-full	 border-b-2 ">
    @if ($index == 0)
        <div class="border-t-2">
        </div>
    @endif
    <div class="w-full flex  border-r-2 video">
        <div wire:sortable.handle
            class="border-box border-l border-r  bg-gray-100 bg-opacity-70 self-stretch flex-none flex flex-col items-center justify-center cursor-pointer hover:bg-gray-200">
            <svg class="h-6 w-6 mx-1.5 my-auto my-auto opacity-50 " viewBox="0 0 64 64">
                <path d="M46,30H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,30.9,47.1,30,46,30z"></path>
                <path d="M46,42H18c-1.1,0-2,0.9-2,2c0,1.1,0.9,2,2,2h28c1.1,0,2-0.9,2-2C48,42.9,47.1,42,46,42z"></path>
                <path d="M18,22h28c1.1,0,2-0.9,2-2c0-1.1-0.9-2-2-2H18c-1.1,0-2,0.9-2,2C16,21.1,16.9,22,18,22z"></path>
            </svg>
        </div>
        <div class="w-full flex m-4">
            <div style="width: 190px; height: 95px;">
                <x-video-embed :video="$video" />
            </div>
            <div class="h-3 w-3 mx-0.5">
                <a href="{{ $url }}" target="_blank" class=" opacity-20 hover:opacity-50">
                    <svg viewBox="0 0 448 512">
                        <path fill="grey" class="stroke-current stroke-1 text-gray-500"
                            d="M400 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zm-6 400H54a6 6 0 0 1-6-6V86a6 6 0 0 1 6-6h340a6 6 0 0 1 6 6v340a6 6 0 0 1-6 6zm-54-304l-136 .145c-6.627 0-12 5.373-12 12V167.9c0 6.722 5.522 12.133 12.243 11.998l58.001-2.141L99.515 340.485c-4.686 4.686-4.686 12.284 0 16.971l23.03 23.029c4.686 4.686 12.284 4.686 16.97 0l162.729-162.729-2.141 58.001c-.136 6.721 5.275 12.242 11.998 12.242h27.755c6.628 0 12-5.373 12-12L352 140c0-6.627-5.373-12-12-12z" />
                    </svg>
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

