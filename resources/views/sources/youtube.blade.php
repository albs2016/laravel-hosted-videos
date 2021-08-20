@props(['video'])

<iframe {{ $attributes }}class="ytplayer" type="text/html" width="100%" height="100%"
    src="https://www.youtube.com/embed/{{ $video->video_id }}?rel=0&modestbranding" frameborder="0"
    webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
