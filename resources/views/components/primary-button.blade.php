@props([
'additionClass',
])

@php
$class="py-2 px-6 border font-medium text-base rounded-lg " . $additionClass
@endphp

<button {{ $attributes->merge(['class'=>$class]) }}>
    {{ $slot }}
</button>