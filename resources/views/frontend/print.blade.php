<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangladesh Air Force Museum</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        .invoice_container {
            margin: 0 auto;
            max-width: 5.8in;
            /* Matches the print page size */
            padding: 10px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .items .sub_heading {
            font-size: 12.5px;
            text-transform: uppercase;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .items thead tr th:first-child,
        .items tbody tr td:first-child {
            width: 30%;
            word-break: break-word;
            text-align: left;
        }

        .sub_heading.qty {
            width: 20%;
        }

        .sub_heading.rate {
            width: 15%;
        }

        .sub_heading.amount {
            width: 25%;
            text-align: right;
        }

        .items td {
            font-size: 12px;
            text-align: right;
            vertical-align: bottom;
        }

        .line {
            border-top: 1px solid black !important;
        }

        .total {
            font-size: 13px;
            text-align: right;
            border-top: 1px dashed black !important;
            border-bottom: 1px dashed black !important;
        }

        footer {
            font-size: 12px;
            text-align: center;
        }

        @media print {
            .container {
                margin: 0;
                padding: 0;
                font-family: 'Roboto', sans-serif !important;
            }

            @page {
                size: 5.8in 11in;
                margin: 0;
            }

            body * {
                visibility: hidden;
            }

            #invoice,
            #invoice * {
                visibility: visible;
            }

            #invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }

        @media screen and (max-width: 768px) {
            .invoice_container {
                padding: 5px;
            }

            .items .sub_heading {
                font-size: 11px;
            }

            .items td {
                font-size: 10px;
            }

            footer {
                font-size: 10px;
            }
        }

        @media screen and (max-width: 480px) {
            .invoice_container {
                padding: 5px;
                width: 100%;
                /* Full width on small screens */
            }

            table {
                font-size: 9px;
            }

            .items .sub_heading {
                font-size: 10px;
            }

            footer {
                font-size: 9px;
            }
        }

        @media screen and (max-width: 320px) {
            .invoice_container {
                padding: 5px;
                width: 100%;
                /* Adjust for very small devices */
            }

            table {
                font-size: 8px;
            }

            .items td {
                font-size: 8px;
            }

            footer {
                font-size: 8px;
            }
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin: 10px;">
        {{-- <button type="button" class="btn btn-danger" id="printBtn" onclick="printInvoice()">Print</button> --}}
    </div>

    <div id="invoice" class="invoice_container">
        <div style="text-align: center;">
            <div style="font-size: 6px; font-weight: 600;">Bangladesh Air Force Museum</div>
            <address style="font-size: 6px;">
                <span>Agargaon, Dhaka - Bangladesh</span><br>
                <span>+8801769-975718</span>
            </address>
            <div style="font-size: 7px; margin: 0px;"><Strong>PARKING</Strong></div>
            <div style="font-size: 7px; margin: 0px;">#{{ $order->phone }}</div>
        </div>
        <div style="text-align: center;">
            {{-- <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code Not Found"> --}}
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
                @if (!empty($order->name))
                    <tr>
                        <td colspan="2" style="text-align:right;">Name</td>
                        <td colspan="2">{{ $order->name }}</td>
                    </tr>
                @endif

                @if (!empty($order->phone))
                    <tr>
                        <td colspan="2" style="text-align:right;">Cell</td>
                        <td colspan="2">{{ $order->phone }}</td>
                    </tr>
                @endif

            </tbody>
        </table>
        <footer>
            <p>Thank you for your visit!</p>
        </footer>
    </div>

    <script>
        function invoice() {
            let orderId = "{{ $order->id }}"; // Get order ID from Blade

            if (!sessionStorage.getItem("printed_" + orderId)) {
                sessionStorage.setItem("printed_" + orderId, "true");
                window.print();
            }
        }
        window.onload = invoice;
    </script>

    <script>
        function invoice() {
            let orderId = "{{ $order->id }}"; // Get order ID from Blade

            if (!sessionStorage.getItem("printed_" + orderId)) {
                sessionStorage.setItem("printed_" + orderId, "true");
                window.print();
            }
        }
        window.onload = invoice;
    </script>

    {{-- <script>
        function printInvoice() {
            document.getElementById('invoice');
            window.print();
        };
    </script> --}}

</body>

</html>
