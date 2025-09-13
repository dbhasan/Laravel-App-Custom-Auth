@extends('frontend.layouts')
@section('content')

  <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center">
            <h1 class="mb-4 fw-bold">Welcome to ISP Management System</h1>
            <p class="lead mb-4">Manage your internet service efficiently with our powerful software.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                Admin Login
            </a>
        </div>
    </div>

@endsection
