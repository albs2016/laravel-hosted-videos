@props(['property'])
<div class="mb-2 w-full items-center">
    <div class="w-full flex flex-row items-stretch h-8" x-data="{url: ''}">
        <input class="w-full border-2 " x-model="url">
        <button
            class="w-32 border-2 border-opacity-100 border-gray-300 transition-colors duration-300 bg-transparent bg-opacity-80 bg-gray-100 hover:bg-blue-300 mx-0.5 px-0.5 rounded-lg "
            x-on:click.prevent="$wire.addHostedVideo(url,'{{ $property }}'), url = ''">{{-- ,{{ $property }})"> --}}
            {{ __('Add Video') }} </button>
    </div>
    <div class="  text-gray-500 text-xs ">
        Please enter the URL of the video here.
    </div>
    @error('url')
        <div class="mt-0.5 list-disc list-inside text-sm text-red-600">
            {{ $message }}
        </div>
    @enderror

    <button
        class="w-32 border-2 border-opacity-100 border-gray-300 transition-colors duration-300 bg-transparent bg-opacity-80 bg-gray-100 hover:bg-blue-300 mx-0.5 px-0.5 rounded-lg "
        wire:click.prevent="dumpArray('{{ $property }}')">{{-- ,{{ $property }})"> --}}
        {{ __('dumpArray') }} </button>
</div>
{{-- <div class="mb-2 w-full items-center">
    <div class="w-full flex flex-row items-stretch h-8">
        <input class="w-full border-2 " wire:model="url">
        <button
            class="w-32 border-2 border-opacity-100 border-gray-300 transition-colors duration-300 bg-transparent bg-opacity-80 bg-gray-100 hover:bg-blue-300 mx-0.5 px-0.5 rounded-lg "
            wire:click.prevent="addHostedVideo(url)">
            {{ __('Add Video') }}
        </button>
    </div>
    <div class="text-gray-500 text-xs ">
        Please enter the URL of the video here.
    </div>
    @error('url')
        <div class="mt-0.5 list-disc list-inside text-sm text-red-600">
            {{ $message }}
        </div>
    @enderror
</div> --}}
