@extends('backend.layouts')
@section('content')
    <main id="main" class="main">
        <div class="d-flex justify-content-between">
            <div class="pagetitle">
                <h1>Right List</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
            <div class="text-end pt-2">
                <a href="{{ route('create.right')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Add Right</a>
            </div>
        </div>
        <hr>
        <div class="custom-scrollbar-table">
            <table id="myTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Module</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rights as $right)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $right->name}}</td>
                            <td>{{ $right->module}}</td>
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('edit.right', $right->id) }}" class="btn text-primary mx-1"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('delete.right', $right->id) }}" method="POST" class="d-inline deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn text-danger btnDelete"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }} "></script>
@endsection
