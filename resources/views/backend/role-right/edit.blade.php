@extends('backend.layouts')
@section('content')
    <main id="main" class="main pt-0">
        <div class="card">
            <div class="d-flex justify-content-between bg-success-subtle px-4 pt-3">
                <div class="pagetitle">
                    <h1>Update Role</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>
                </div>
                <div class="text-end pt-2">
                    <a href="{{ route('index.role') }}" class="btn btn-primary"><i class="fa-regular fa-eye"></i>
                        View Role</a>
                </div>
            </div>
            <div class="custom-scrollbar-table p-5">
                <form action="{{ route('get.right.for.role', $role->id) }}" method="POST">
                    @csrf
                    <table id="myTable" class="display" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">SL</th>
                                <th style="width: 15%;">Module</th>
                                <th>Right</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rights as $module => $moduleRights)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $module }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($moduleRights as $right)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="rights[]"
                                                        value="{{ $right->id }}" id="right_{{ $right->id }}"
                                                        {{ in_array($right->id, $selectedRights) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="right_{{ $right->id }}">
                                                        {{ $right->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Rights</button>
                    </div>
                </form>
            </div>

        </div>

    </main>
@endsection
