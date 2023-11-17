@extends('admin.layouts.application', [
'menu' => 'hotels',
'title' => 'Chỉnh sửa Khách Sạn',
])

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">
            <a href="{{route('hotels.index')}}" class="text-muted fw-light">
                Khách sạn</a> /</span> Chỉnh sửa
    </h4>
    <div class="card mb-4">
        <h5 class="card-header">Nhập Thông Tin Khách Sạn</h5>
        <div class="card-body">
            <form action="{{ route('hotels.update', [$hotel]) }}" method="POST" enctype="multipart/form-data" id="formHotel">
                @csrf
                @method('PUT')
                <div class="form-floating form-floating-outline mb-4">
                    <input class="form-control" type="text" placeholder="Tên Block" name="name" value="{{ $hotel->name }}" />
                    <label for="html5-text-input">Tên Khách Sạn</label>
                </div>

                <div class="form-floating form-floating-outline mb-4">
                    <input class="form-control" type="text" placeholder="Vị trí" name="location" value="{{ $hotel->location }}" />
                    <label for="html5-text-input">Địa chỉ</label>
                </div>

                <div class="form-floating form-floating-outline mb-4">
                    <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" name="description" placeholder="Mô tả về khách sạn...">{{ $hotel->description }}</textarea>
                    <label for="exampleFormControlTextarea1">Mô tả khách sạn</label>
                </div>

                <div class="form-floating form-floating-outline mb-4">
                    <p>Số sao khách sạn</p>
                    <div class="form-check form-check-inline">
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            name="level" 
                            id="inlineRadio1" 
                            value="1"
                            {{ $hotel->level == 1 ? 'checked' : '' }}
                            
                        >
                        <label class="form-check-label" for="inlineRadio1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            name="level" 
                            id="inlineRadio2" 
                            {{ $hotel->level == 2 ? 'checked' : '' }}
                            value="2"
                        >
                        <label class="form-check-label" for="inlineRadio2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            name="level" 
                            id="inlineRadio3" 
                            {{ $hotel->level == 3 ? 'checked' : '' }}
                            value="3"
                        >
                        <label class="form-check-label" for="inlineRadio3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            name="level" 
                            id="inlineRadio4" 
                            {{ $hotel->level == 4 ? 'checked' : '' }}
                            value="4"
                        >
                        <label class="form-check-label" for="inlineRadio4">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            name="level" 
                            id="inlineRadio5" 
                            {{ $hotel->level == 5 ? 'checked' : '' }}
                            value="5"
                        >
                        <label class="form-check-label" for="inlineRadio5">5</label>
                    </div>
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="isTop" @if($hotel->isTop) checked @endif
                    />
                    <label class="form-check-label" for="flexSwitchCheckChecked">Is Top</label>
                </div>

                <div style="margin: 10px 0;">
                    <p>Danh sách loại phòng</p>
                    <div id="listTypeRoom" class="">
                        @foreach($typeRooms as $typeRoom)
                        
                        <div class="inputGroup">
                            <div class="divider text-start-center divider-info">
                                <div class="divider-text">Loại phòng {{ $loop->index + 1 }}</div>
                            </div>
                            <div class="row">
                                <div class="col mb-4 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input 
                                            type="text" 
                                            id="nameWithTitle" 
                                            name="roomName[]" 
                                            class="form-control" 
                                            placeholder="Enter Name"
                                            value="{{ $typeRoom->name }}"
                                        />
                                        <label for="nameWithTitle">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-floating form-floating-outline">
                                        <input 
                                            type="number" 
                                            name="roomPrice[]" 
                                            id="priceWithTitle" 
                                            class="form-control" 
                                            placeholder="1.000.000đ"
                                            value="{{ $typeRoom->price }}"
                                        >
                                        <label for="priceWithTitle">Giá</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating form-floating-outline">
                                        <input 
                                            type="number" 
                                            name="available[]" 
                                            id="availableWithTitle" 
                                            class="form-control" 
                                            placeholder="100"
                                            value="{{ $typeRoom->available }}"
                                        >
                                        <label for="availableWithTitle">Phòng trống</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 md-6">
                                <div class="form-floating form-floating-outline">
                                    <input 
                                        class="form-control" 
                                        type="file" 
                                        name="image[]" 
                                        onchange="handleChangeImg(event)"
                                    />
                                    <label for="html5-text-input" class="fw-medium px-2 pt-2">Hình Ảnh</label>
                                </div>
                            </div>
                            <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete" style="margin: 0px;">
                                <div class="dz-details">
                                    <div class="dz-thumbnail">
                                        <img src="{{ asset($typeRoom->image) }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn rounded-pill btn-outline-danger waves-effect" onclick="handleDeleteTypeRoom(event)">
                                    Xoá
                                </button>
                                <button type="button" class="btn rounded-pill btn-outline-primary waves-effect" onclick="handleAddTypeRoom(event)">
                                    Thêm
                                </button>
                            </div>
                            <input type="hidden" name="typeRoomId[]" value="{{ $typeRoom->id }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    const getParrentElements = (element, selector) => {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement
            }
            element = element.parentElement
        }
    }
    const handleAddTypeRoom = (e) => {
        const listTypeRoom = document.getElementById('listTypeRoom')
        const countTypeRoom = listTypeRoom.querySelectorAll('.inputGroup').length
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('inputGroup')
        inputGroup.innerHTML = `
            <div class="divider text-start-center divider-info">
                <div class="divider-text">Loại phòng ${countTypeRoom + 1}</div>
            </div>
            <div class="row">
                <div class="col mb-4 mt-2">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="nameWithTitle" name="roomName[]" class="form-control" placeholder="Enter Name">
                        <label for="nameWithTitle">Name</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-floating form-floating-outline">
                        <input type="number" name="roomPrice[]" id="priceWithTitle" class="form-control" placeholder="1.000.000đ">
                        <label for="priceWithTitle">Giá</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating form-floating-outline">
                        <input type="number" name="available[]" id="availableWithTitle" class="form-control" placeholder="100">
                        <label for="availableWithTitle">Phòng trống</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4 md-6">
                <div class="form-floating form-floating-outline">
                    <input class="form-control" type="file" id="formFile" name="image[]" onchange="handleChangeImg(event)" />
                    <label for="html5-text-input" class="fw-medium px-2 pt-2">Hình Ảnh</label>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn rounded-pill btn-outline-danger waves-effect" onclick="handleDeleteTypeRoom(event)">
                    Xoá
                </button>

                <button type="button" class="btn rounded-pill btn-outline-primary waves-effect" onclick="handleAddTypeRoom(event)">
                    Thêm
                </button>
            </div>
            <input type="hidden" name="typeRoomId[]" value="">
        `
        listTypeRoom.appendChild(inputGroup)
        e.target.classList.add('d-none');
    }

    const handleDeleteTypeRoom = (e) => {
        const listTypeRoom = document.getElementById('listTypeRoom')
        const parentElement = getParrentElements(e.target, '.inputGroup')
        parentElement.remove()
        const listInputGroup = listTypeRoom.querySelectorAll('.inputGroup');
        const lastInputGroup = listInputGroup[listInputGroup.length - 1];
        lastInputGroup.querySelector('.d-none').classList.remove('d-none');
    }

    const handleChangeImg = (e) => {
        const parentElement = getParrentElements(e.target, '.inputGroup')

        if (parentElement.querySelector('.dz-preview.dz-processing.dz-image-preview')) {
            const imgTag = parentElement.querySelector('.dz-preview.dz-processing.dz-image-preview img')
            imgTag.src = URL.createObjectURL(e.target.files[0])
        } else {
            const previewElement = document.createElement('div')
            previewElement.innerHTML = `
                <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete" style="margin: 0px;">
                    <div class="dz-details">
                        <div class="dz-thumbnail">
                            <img src="${URL.createObjectURL(e.target.files[0])}" />
                        </div>
                    </div>
                </div>
            `
            parentElement.appendChild(previewElement)
        }
    }
</script>