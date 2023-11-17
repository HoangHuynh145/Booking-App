@props([
    'name',
    'show' => false,
])

<div 
    class="fixed w-screen h-screen bg-black/20 top-0 left-0 hidden"
    x-data="{
        show: @js($show)
    }"
    x-show="show"
    x-on:open-modal.window="$event.detail === '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="show = false"
    :style="$show ? display: block : display: none"
    @click="show = false"
    id="modal"
>
    <div class="flex-center h-full" >
        <div class="bg-white rounded-lg " @click.stop="">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('modal')

    setTimeout(() => {
        modal.classList.remove('hidden')
    }, 1000);

</script>