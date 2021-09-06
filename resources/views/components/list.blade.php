<div>


    <div class="w-full items-center border-2 border-opacity-100 border-gray-300  bg-opacity-80 bg-gray-100 pt-1 pl-1">
        <div class="w-full flex flex-row items-stretch h-8">


            <input class="w-full border-2 " wire:model="url">
            <button
                class="w-32 border-2 border-opacity-100 border-gray-300 transition-colors duration-300 bg-transparent bg-opacity-80 bg-gray-100 hover:bg-blue-300 ml-0.5 px-0.5 rounded-lg "
                wire:click.prevent="addHostedVideo()">
                Add Video
            </button>
        </div>
        <div class="text-gray-500 text-xs ">
            Please enter the URL of a Youtube or Vimeo video here.
        </div>
    </div>

    <ul drag-root>
        @forelse($hosted_videos as $video)
            @include('hosted-videos::components.item')
        @empty
        @endforelse
    </ul>

    <script>
        let root = document.querySelector('[drag-root]')

        root.querySelectorAll('[drag-item]').forEach(el => {
            el.addEventListener('dragstart', e => {
                console.log('start')
            })

            el.addEventListener('dragenter', e => {
                console.log('enter')
            })

            el.addEventListener('dragleave', e => {
                console.log('leave')
            })

            el.addEventListener('dragend', e => {
                console.log('end')
            })
        })
    </script>
</div>
