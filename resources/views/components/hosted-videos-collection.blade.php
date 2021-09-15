{{-- @props(['model']) --}}
<div>
    <livewire:livewire-hosted-videos-collection :model="$model" :collection="$collection" :listView="$listView"
        :itemView="$itemView" :propertiesView="$propertiesView" :inputView="$inputView"
        :customProperties="$customProperties" />
</div>
