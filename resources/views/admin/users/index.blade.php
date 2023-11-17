@extends('admin.layouts.application', [
'menu' => 'users',
'title' => 'Quản lý Người Dùng',
])

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Người Dùng /</span> Danh Sách</h4>
    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <form class="d-flex" action="{{ route('users.index') }}" method="GET">
                <input name="q" email="q" value="{{$q}}" type="text" class="form-control" id="floatingInput" placeholder="Tên hoặc email" style="height: 38.42px;" />
                <button type="submit" class="btn btn-primary" style=" height: 38.42px; width: 300px; margin-left: 20px;">
                    Tìm Kiếm
                </button>
            </form>
            <a href="{{route('blocks.create')}}" class="btn btn-outline-primary waves-effect">
                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline me-1"></span>
                Tạo Mới
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            @include('admin.partials.notification')
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Họ Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Ngày Tạo</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <span class="fw-medium">{{ $user->fullName }}</span>
                        </td>
                        <th>{{ $user->phone }}</th>
                        <th class="text-none">{{ $user->email }}</th>
                        <th class="text-none">{{ $user->role == 0 ? 'User' : 'Admin' }}</th>
                        <th>{{ $user->created_at->format('d/m/Y') }}</th>
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
                {{ $users->render('admin.partials.paging') }}
            </nav>
            <!--/ Outline rounded Pagination -->
        </div>
    </div>
</div>
@endsection