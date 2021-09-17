@props(['video', 'customProperty'])




@if (!empty(json_decode($video->custom_properties)->$customProperty))

    <input {{ $attributes }} x-data="" value="{{ json_decode($video->custom_properties)->$customProperty }}"
        name="video-{{ $video->id }}-{{ $customProperty }}"
        x-on:keyup.debounce="$wire.updateHostedVideoCustomProperties({{ $video->id }},  '{{ $customProperty }}' ,document.getElementsByName('video-{{ $video->id }}-{{ $customProperty }}')[0].value )" />
@else
    <input {{ $attributes }} x-data="" value="" name="video-{{ $video->id }}-{{ $customProperty }}"
        x-on:keyup.debounce="$wire.updateHostedVideoCustomProperties({{ $video->id }},  '{{ $customProperty }}' ,document.getElementsByName('video-{{ $video->id }}-{{ $customProperty }}')[0].value )" />
@endif
