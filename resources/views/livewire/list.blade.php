<div>
    {{-- @include('hosted-videos::livewire.input') --}}
    <x-dynamic-component :component="$inputView" />
    <ul wire:sortable="reorder" id="hosted">
        @forelse($hosted_videos as $video)

            {{-- {{ $itemView }} --}}
            {{-- @include( $itemView ) --}}
            <x-dynamic-component :component="$itemView" :video='$video' :propertiesView='$propertiesView' />
            {{-- dynamic component here --}}
            {{-- <x-item :video='$video' /> --}}

        @empty
        @endforelse
    </ul>


</div>
