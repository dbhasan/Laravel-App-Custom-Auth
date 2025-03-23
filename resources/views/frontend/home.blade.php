@extends('frontend.layouts')
@section('content')
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

<h1>This is Website</h1>

<div class="card m-5 p-5">
    <form id="printForm" enctype="multipart/form-data" class="row g-3 p-3">
        @csrf

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="col-md-6 pb-3">
            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
            <span class="text-danger error-name"></span>
        </div>

        <div class="col-md-6 pb-3">
            <label for="phone" class="form-label">Number<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="phone" name="phone" required>
            <span class="text-danger error-phone"></span>
        </div>

        <div class="col-md-12 pb-3">
            <label for="data" class="form-label">Text<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="data" name="data" >
            <span class="text-danger error-data"></span>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit & Print</button>
        </div>
    </form>
</div>

<!-- Modal for Print Preview -->
<div id="invoice" style="margin: 0 auto; max-width: 5.8in; padding: 10px; box-sizing: border-box;" >
    <div style="text-align: center;">
        <div style="font-size: 6px; font-weight: 600;">Bangladesh Air Force Museum</div>
        <address style="font-size: 6px; margin-bottom: 0px">
            <span>Agargaon, Dhaka - Bangladesh</span><br>
            <span>+8801769-975718</span>
        </address>
        <div style="font-size: 7px; margin: 0px;"><Strong>ENTRIES TICKET</Strong></div>
        <div style="font-size: 7px; margin: 0px;" id="printReference"></div>
    </div>
    <div style="text-align: center; margin-bottom: 1px">
        <img id="qrCodeImage" src="" alt="QR Code">
    </div>
    <table class="items" style="width: 100%; font-size: 7px;">
        <thead>
            <tr>
                <th style="font-size: 6px; font-weight: 600; text-transform: uppercase; border-top: 1px solid black; border-bottom: 1px solid black; text-align:left;">Bill To</th>
                <th style="font-size: 6px; font-weight: 600; text-transform: uppercase; border-top: 1px solid black; border-bottom: 1px solid black;"></th>
                <th style="font-size: 6px; font-weight: 600; text-transform: uppercase; border-top: 1px solid black; border-bottom: 1px solid black;"></th>
                <th style="font-size: 6px; font-weight: 600; text-transform: uppercase; border-top: 1px solid black; border-bottom: 1px solid black; text-align:right;" id="printDate">10/03/2025</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="2" style="text-align:left; font-size: 7px;">Name</td>
                <td colspan="2" style="text-align:right; font-size: 7px;" id="printName"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:left; font-size: 7px;">Cell</td>
                <td colspan="2" style="text-align:right; font-size: 7px;" id="printPhone"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:left; font-size: 7px;">Type</td>
                <td colspan="2" style="text-align:right; font-size: 7px;" id="printData"></td>
            </tr>

        </tbody>
    </table>
    <footer style="font-size: 7px; text-align:center;">
        <p>Thank you for your visit!</p>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

<script>
    $(document).ready(function() {
        $("#printForm").on("submit", function(e) {
            e.preventDefault(); // Prevent default form submission

            $(".error-name, .error-phone, .error-data").text(""); // Clear previous errors

            $.ajax({
                url: "{{ route('print.post') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        // Populate print section
                        $("#printName").text(response.data.name);
                        $("#printPhone").text(response.data.phone);
                        $("#printData").text(response.data.data);
                        $("#qrCodeImage").attr("src", "data:image/png;base64," + response.qrCode);

                        // Print the section
                        printJS({
                            printable: "invoice",
                            type: "html",
                            css: "https://printjs-4de6.kxcdn.com/print.min.css"
                        });

                        // Reset the form fields after successful submission
                        $('#printForm')[0].reset();
                    }
                },
                // error: function(xhr) {
                //     if (xhr.responseJSON && xhr.responseJSON.errors) {
                //         let errors = xhr.responseJSON.errors;
                //         if (errors.name) $(".error-name").text(errors.name[0]);
                //         if (errors.phone) $(".error-phone").text(errors.phone[0]);
                //         if (errors.data) $(".error-data").text(errors.data[0]);
                //     }
                // }
                error: function(xhr) {
                    if (xhr.status === 422) { // Validation error
                        let errors = xhr.responseJSON.errors;
                        if (errors.name) $(".error-name").text(errors.name[0]);
                        if (errors.phone) $(".error-phone").text(errors.phone[0]);
                        if (errors.data) $(".error-data").text(errors.data[0]);
                    } else {
                        alert("Something went wrong! Please try again.");
                    }
                }

            });
        });
    });

</script>

@endsection
