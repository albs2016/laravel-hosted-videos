<div>


    <div class="w-full items-center border-2 border-opacity-100 border-gray-300  bg-opacity-80 bg-gray-100 pt-1 pl-1">
        <div class="w-full">
            <input class="w-11/12  items-center border-2" wire:model="url">
            <button
                class="items-center border-2 border-opacity-100 border-gray-300 transition-colors duration-300 bg-transparent bg-opacity-80 bg-gray-100 hover:bg-blue-300 px-1 rounded-lg "
                wire:click.prevent="addHostedVideo()">
                Add Video
            </button>
        </div>
        <div class="text-gray-500 text-xs ">
            Please enter the URL of a Youtube or Vimeo video here.
        </div>
    </div>

    <ul>
        @forelse($hosted_videos as $video)
            @include('hosted-videos::components.item')
        @empty
        @endforelse
    </ul>


</div>
