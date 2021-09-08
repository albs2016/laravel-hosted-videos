<div>

    <div
        class="mb-2 w-full items-center border-2 border-opacity-100 border-gray-300  bg-opacity-80 bg-gray-100 pt-1 pl-1">
        <div class="w-full flex flex-row items-stretch h-8">


            <input class="w-full border-2 " wire:model="url">
            <button
                class="w-32 border-2 border-opacity-100 border-gray-300 transition-colors duration-300 bg-transparent bg-opacity-80 bg-gray-100 hover:bg-blue-300 mx-0.5 px-0.5 rounded-lg "
                wire:click.prevent="addHostedVideo()">
                Add Video
            </button>
        </div>
        <div class="text-gray-500 text-xs ">
            Please enter the URL of a Youtube or Vimeo video here.
        </div>
        @error('url')
            <div class="mt-0.5 list-disc list-inside text-sm text-red-600">
                {{ $message }}
            </div>
        @enderror
    </div>

    <ul drag-root wire:sortable="reorder" class="border-t-2">
        @forelse($hosted_videos as $video)
            @include('hosted-videos::components.item')
        @empty
        @endforelse
    </ul>
</div>
