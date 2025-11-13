@extends('Admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('contents')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="javascript:void(0);">Dashboard</a>
            </li>
        </ol>
    </nav>
    <div class="card p-2 shadow-lg">
        <div class="m-3 d-flex justify-content-between align-items-center">
            <h3>Welcome to Dasboard Admin</h3>
        </div>
    </div>
@endsection