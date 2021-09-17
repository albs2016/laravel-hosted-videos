<div>
    <x-dynamic-component :component="$inputView" />
    <ul wire:sortable="reorder" id="hosted">
        @forelse($hosted_videos as $video)
            <x-dynamic-component :component="$itemView" :video='$video' :propertiesView='$propertiesView'
                :url='$this->getVideoURL($video)' :index='$loop->index' />
        @empty
        @endforelse
    </ul>
</div>
