@props(['property', 'collection' => 'default', 'propertiesView'])
{{-- <div>
    <x-dynamic-component :component="$inputView" />
    <ul wire:sortable="reorder" id="hosted">

        @forelse($this->$property as $video)
            <x-dynamic-component :component="$itemView" :video='$video' :propertiesView='$propertiesView'
                :url='$this->getVideoURL($video)' :index='$loop->index' />
        @empty
        @endforelse
    </ul>
</div> --}}


<div>
    <x-dynamic-component :component="$inputView ?? 'input'" :property="$property" />
    <ul wire:sortable="reorder" id="hosted">

        @forelse(collect($this->$property)->where('collection_name',$collection) as $index => $video)
            <li wire:sortable.item="{{ $property }}-{{ $index }}" class="relative border-b-2 "
                wire:key="{{ $property }}-{{ $index }}">
                <input type="hidden" wire:model="{{ $property }}.{{ $index }}.video_id" />
                <input type="hidden" wire:model="{{ $property }}.{{ $index }}.order" />
                <input type="hidden" wire:model="{{ $property }}.{{ $index }}.collection_name" />
                <input type="hidden" wire:model="{{ $property }}.{{ $index }}.custom_properties" />
                {{-- <input wire:model="{{ $property }}.{{ $index }}.source" /> --}}
                {{-- {{ $this->$property[$index]->source }} --}}
                <x-dynamic-component :component="$itemView ?? 'item'" :video='$video'
                    :propertiesView="$propertiesView ?? ''" :url='$this->getVideoURL($video)' :index='$loop->index'
                    :property="$property" />

            </li>
        @empty
        @endforelse

    </ul>
</div>
