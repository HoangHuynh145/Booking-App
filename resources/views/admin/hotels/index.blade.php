@extends('admin.layouts.application', [
'menu' => 'hotels',
'title' => 'Quản lý Khách sạn',
])

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Khách sạn /</span> Danh Sách</h4>
    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <form class="d-flex" action="{{ route('hotels.index') }}" method="GET">
                <input type="text" name="q" value="{{$q}}" class="form-control" id="floatingInput" placeholder="Tên khách sạn" style="height: 38.42px;" />
                <button type="submit" class="btn btn-primary" style=" height: 38.42px; width: 300px; margin-left: 20px;">
                    Tìm Kiếm
                </button>
            </form>
            <a href="{{route('hotels.create')}}" class="btn btn-outline-primary waves-effect">
                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline me-1"></span>
                Tạo Mới
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            @include('admin.partials.notification')
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tên Khách Sạn</th>
                        <th>Địa chỉ</th>
                        <th>Số Loại phòng</th>
                        <th>Ngày Tạo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($hotels as $hotel)
                    <tr>
                        <td>
                            <p class="fw-medium" style="max-width: 85%; text-overflow: ellipsis; overflow: hidden !important;">{{ $hotel->name }}</p>
                        </td>
                        <td >
                            <p class="fw-medium" style="max-width: 85%; text-overflow: ellipsis; overflow: hidden !important;">{{ $hotel->location }}</p>
                        </td>
                        <td>
                            <span class="fw-medium">{{ $hotel->numberRoom }}</span>
                        </td>
                        <th>{{ $hotel->created_at->format('d/m/Y') }}</th>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('hotels.edit', [$hotel]) }}">
                                        <i class="mdi mdi-pencil-outline me-1"></i> Cập Nhật
                                    </a>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#onboardImageModal-{{$hotel->id}}">
                                        <i class="mdi mdi-trash-can-outline me-1"></i> Xóa
                                    </a>
                                </div>
                                <!-- Form with Image Modal -->
                                <div class="modal-onboarding modal fade animate__animated" id="onboardImageModal-{{$hotel->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content text-center">
                                            <div class="modal-header border-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="onboarding-media">
                                                    <div class="mx-2">
                                                        <i class="menu-icon tf-icons mdi mdi-information-outline mdi-48px text-warning"></i>
                                                    </div>
                                                </div>
                                                <div class="onboarding-content mb-0">
                                                    <h4 class="onboarding-title text-body">Bạn có chắc chắn muốn xóa?</h4>
                                                </div>
                                            </div>
                                            <form action="{{ route('hotels.destroy', [$hotel]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-footer border-0">
                                                    <a class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Hủy
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">Xóa</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Form with Image Modal -->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="demo-inline-spacing">
            <!-- Outline rounded Pagination -->
            <nav aria-label="Page navigation">
                {{ $hotels->render('admin.partials.paging') }}
            </nav>
            <!--/ Outline rounded Pagination -->
        </div>
    </div>
</div>
@endsection