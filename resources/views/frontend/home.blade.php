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
        {{-- @if (!empty($order))
            <div id="invoice" class="invoice_container">
                <div class="ride_container">
                    <div style="text-align: center;">
                        <div style="font-size: 6px; font-weight: 600;">Bangladesh Air Force Museum</div>
                        <address style="font-size: 6px;">
                            <span>Agargaon, Dhaka - Bangladesh</span><br>
                            <span>+8801769-975718</span>
                        </address>
                        <strong style="font-size: 7px; margin: 0px;">RIDE TICKET</strong>
                        <span style="font-size: 7px; margin: 0px;">{{ $order->phone }}</span>
                    </div>
                    <div style="text-align: center;">
                        <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code Not Found">
                    </div>
                    <table class="items">
                        <thead>
                            <tr>
                                <th class="sub_heading name">Bill To</th>
                                <th class="sub_heading qty"></th>
                                <th class="sub_heading rate"></th>
                                <th class="sub_heading amount">{{ $order->created_at }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td colspan="2" style="text-align:right;">Ride Name</td>
                                <td colspan="2" style="text-align:right;">{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:right;">Viewers</td>
                                <td colspan="2" style="text-align:right;">{{ $order->phone }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif --}}
    </div>
    <script>
        function invoice() {
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = document.getElementById('invoice').innerHTML;
            window.print();
            document.body.innerHTML = originalContent;
        };
        window.onload = invoice;
    </script>
@endsection
