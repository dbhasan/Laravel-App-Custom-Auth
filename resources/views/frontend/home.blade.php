@extends('frontend/layouts')
@section('content')
    <h1>This is Website</h1>
    <div class="card m-5 p-5">
        <form method="post" action="{{ route('print.post') }}" enctype="multipart/form-data" class="row g-3 p-3">
            @csrf

            <div class="col-md-6 pb-3">
                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 pb-3">
                <label for="phone" class="form-label">Number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="phone" value="{{ old('phone') }}"
                    required>
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 pb-3">
                <label for="data" class="form-label">Text<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="data" name="data" value="{{ old('data') }}"
                    required>
                @error('data')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
