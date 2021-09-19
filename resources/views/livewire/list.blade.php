@props(['property'])
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

        @forelse($this->$property as $video)
            <x-dynamic-component :component="$itemView ?? 'item'" :video='$video'
                :propertiesView="$propertiesView ?? ''" :url='$this->getVideoURL($video)' :index='$loop->index'
                :property="$property" />
        @empty
        @endforelse
    </ul>
</div>
