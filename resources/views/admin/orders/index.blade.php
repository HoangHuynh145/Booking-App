@extends('admin.layouts.application', [
'menu' => 'orders',
'title' => 'Quản lý Đơn Hàng',
])

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Đơn Hàng /</span> Danh Sách</h4>
    <!-- Hoverable Table rows -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div></div>
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
                        <th>Mã Đơn Hàng</th>
                        <th>Hình Thức</th>
                        <th>Trạng Thái</th>
                        <th>Tổng Tiền</th>
                        <th>Ngày Check-In</th>
                        <th>Ngày Check-Out</th>
                        <th>Ngày Tạo Đơn</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($orders as $order)
                    <tr>
                        <td>
                            <span class="fw-medium">{{ $order->id }}</span>
                        </td>
                        <th class="text-none">Thanh Toán qua VISA</th>
                        <th class="text-none">Đã Thanh Toán</th>
                        <th class="text-none">{{ number_format($order->totalPayment / 1000, 3) }} VND</th>
                        <th class="text-none">{{ Carbon::parse($order->checkInTime)->format('d/m/Y') }}</th>
                        <th class="text-none">{{ Carbon::parse($order->checkOutTime)->format('d/m/Y') }}</th>
                        <th>{{ $order->created_at->format('d/m/Y') }}</th>
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
                {{ $orders->render('admin.partials.paging') }}
            </nav>
            <!--/ Outline rounded Pagination -->
        </div>
    </div>
</div>
</div>
@endsection