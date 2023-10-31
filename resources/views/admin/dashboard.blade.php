@extends('admin.layouts.application', [
'menu' => 'dashboard',
'title' => 'Thống Kê'
])

@section('content')
<div class="authentication-inner h-full row m-0">
    <div>
        Chào mừng, admin.
    </div>
    <div class="d-flex justify-content-center">
        <img src="{{ asset('admin/assets/img/illustrations/auth-register-illustration-light.png') }}" class="w-auto" height="570px" alt="auth-illustration" style="aspect-ratio: 1/1;" />
    </div>
</div>
@endsection