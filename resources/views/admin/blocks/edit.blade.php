@extends('admin.layouts.application', [
'menu' => 'blocks',
'title' => 'Cập nhật Block',
])

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">
            <a href="{{route('blocks.index')}}" class="text-muted fw-light">
                Block</a> /</span> Chỉnh sửa
    </h4>
    <div class="card mb-4">
        <h5 class="card-header">Nhập Thông Tin Block</h5>
        <div class="card-body">
            <form action="{{ route('blocks.update', [$block]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-floating form-floating-outline mb-4">
                    <input class="form-control" type="text" placeholder="Tên Block" name="name" value="{{ $block->name }}" />
                    <label for="html5-text-input">Tên Block</label>
                </div>
                <div class="mb-4">
                    <textarea class="form-control" name='description' style="height: 100px;" placeholder="Mô tả block">{{ $block->description }}</textarea>
                </div>
                
                <div class="mb-4">
                    <div class="multiselect">
                        <div class="multiselect-wrapper" tabindex="-1">
                            <div class="multiselect-tags" data-tags="">
                                <div class="list-item"></div>
                                <!-- Option Selected -->

                                @foreach ($hotelsInBlock as $hotel)
                                    
                                    <span 
                                        class="multiselect-tag" 
                                        tabindex="-1" 
                                        aria-label="{{ $hotel->name }}❎"
                                        id="hotel-selected-{{ $hotel->id }}"
                                    >
                                        {{ $hotel->name }}
                                        <span class="multiselect-tag-remove" onclick="handleDeleteHotel('{{ $hotel->id }}')">
                                            <span class="multiselect-tag-remove-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#fff" d="m13.41 12l4.3-4.29a1 1 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1 1 0 0 0-1.42 1.42l4.3 4.29l-4.3 4.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l4.29-4.3l4.29 4.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42Z"/></svg>
                                            </span>
                                        </span>
                                    </span>
                                @endforeach
                                
                                
                                <div class="multiselect-tags-search-wrapper">
                                    <span class="multiselect-tags-search-copy"></span>
                                    <div>
                                        <input 
                                            type="text" 
                                            class="multiselect-tags-search" 
                                            onfocus="handleFocus()"
                                            value=""
                                        />
                                    </div>
                                </div>
                            </div>
                            <span aria-hidden="true" tabindex="0" role="button" data-clear="" aria-roledescription="❎" class="multiselect-clear">
                                <img 
                                    src="{{ asset('admin/assets/img/icons/close.svg') }}" 
                                    style="aspect-ratio: 1/1;" 
                                    width="10px"
                                    height="18px"
                                />
                            </span>
                            <span class="multiselect-caret" aria-hidden="true">
                                <img 
                                    src="{{ asset('admin/assets/img/icons/carret.svg') }}" 
                                    style="aspect-ratio: 1/1;" 
                                    width="10px"
                                    height="18px"
                                />
                            </span>
                        </div>
                        <!-- Options -->
                        <div class="multiselect-dropdown is-hidden" tabindex="-1">
                            <ul class="multiselect-options" id="multiselect-options" role="listbox">
                                <!-- List Option -->
                                @if(count($hotelsNotInBlock) > 0 || count($hotelsInBlock) > 0) 
                                    @foreach($hotelsNotInBlock as $hotel)
                                        <li 
                                            class="multiselect-option" 
                                            id="multiselect-option-{{ $hotel->id }}" 
                                            aria-selected="false" 
                                            aria-label="{{ $hotel->name }}" 
                                            role="option"
                                            onclick="handleSelectHotel(event, '{{ $hotel->id }}', '{{ $hotel->name }}')"
                                        >
                                            <span>{{ $hotel->name }}</span>
                                        </li>
                                    @endforeach
                                    @foreach($hotelsInBlock as $hotel)
                                        <li 
                                            class="multiselect-option d-none" 
                                            id="multiselect-option-{{ $hotel->id }}" 
                                            aria-selected="false" 
                                            aria-label="{{ $hotel->name }}" 
                                            role="option"
                                            onclick="handleSelectHotel(event, '{{ $hotel->id }}', '{{ $hotel->name }}')"
                                        >
                                            <span>{{ $hotel->name }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="multiselect-no-options">The list is empty</div>
                                @endif  
                            </ul>
                        </div>
                        <!-- Hidden Value -->
                        <div class="list-hotels-selected d-none">
                            @foreach ($hotelsInBlock as $hotel)
                                <input type="hidden" name="hotelIds[]" value="{{ $hotel->id }}" />
                            @endforeach
                        </div>
                        <div class="multiselect-spacer"></div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const inputSearchSelect = document.querySelector('.multiselect-tags-search')
    const dropdown = document.querySelector('.multiselect-dropdown')
    const multiselect = document.querySelector('.multiselect')
    const inputSearch = document.querySelector('.multiselect-tags-search')

    const handleFocus = () => {
        dropdown.classList.remove('is-hidden')
        multiselect.classList.add('is-open', 'is-active')
    }
    
    const handleSelectHotel = (e, hotelID, hotelName) => {
        const listHotelsSelected = document.querySelector('.list-hotels-selected')
        const listTagSelected = document.querySelector('.multiselect-tags .list-item')

        const inputValue = document.createElement('input')
        inputValue.type = 'hidden'
        inputValue.name = 'hotelIds[]'
        inputValue.value = hotelID
        listHotelsSelected.appendChild(inputValue)

        const hotelItem = document.createElement('span')
        hotelItem.classList.add('multiselect-tag')
        hotelItem.id = `hotel-selected-${hotelID}`
        hotelItem.ariaLabel = `${hotelName} ❎`
        hotelItem.innerHTML = `
            ${hotelName}
            <span class="multiselect-tag-remove" onclick="handleDeleteHotel(${hotelID})">
                <span class="multiselect-tag-remove-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path fill="#fff" d="m13.41 12l4.3-4.29a1 1 0 1 0-1.42-1.42L12 10.59l-4.29-4.3a1 1 0 0 0-1.42 1.42l4.3 4.29l-4.3 4.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l4.29-4.3l4.29 4.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42Z"/></svg>
                </span>
            </span>
        `
        listTagSelected.appendChild(hotelItem)

        e.target.classList.add('d-none')
        dropdown.classList.add('is-hidden')
        multiselect.classList.remove('is-open', 'is-active')
    }

    const handleDeleteHotel = (hotelID) => {
    console.log(`multiselect-option-${hotelID}`)
        const hotelFounded = document.getElementById(`multiselect-option-${hotelID}`)
        const hotelClicked = document.getElementById(`hotel-selected-${hotelID}`)
        const inputHotel = document.querySelector(`input[name='hotelIds[]'][value='${hotelID}']`)
        hotelFounded.classList.remove('d-none')
        hotelClicked.remove()
        inputHotel.remove()
    }

    window.addEventListener('click', (e) => {
        if(!multiselect.contains(e.target)) {
            dropdown.classList.add('is-hidden')
            multiselect.classList.remove('is-open', 'is-active')
        }
    })

</script>
@endsection