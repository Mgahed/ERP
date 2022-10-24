<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px
        }

        .btn-success {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c
        }

        .btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .open > .dropdown-toggle.btn-success {
            color: #fff;
            background-color: #449d44;
            border-color: #398439
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #bb2d3b;
            border-color: #b02a37;
        }

        .btn-check:focus + .btn-danger, .btn-danger:focus {
            color: #fff;
            background-color: #bb2d3b;
            border-color: #b02a37;
            box-shadow: 0 0 0 0.25rem rgba(225, 83, 97, 0.5);
        }

        .btn {

        }

        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        tbody tr {
            border-top: 1.1px dashed;
        }

        td {
            text-align: -webkit-center;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            /*border-right: 1.1px dashed;
            border-left: 1.1px dashed;*/
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 47px;
            max-width: 47px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 100%;
            max-width: 100%;
            margin-top: 25px;
        }

        @media print {
            tbody tr {
                border-top: 2px dashed;
            }

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
    <title>Receipt example</title>
</head>
<body>
<center>
    <div class="ticket">
        <span class="centered">
            <img style="width: 250px; border-radius: 20% !important; position: relative; top: -9px;"
                 src="{{asset('logo.jpeg')}}" alt="Kiki Riki">
        </span>
        <hr style="border-style: dashed;">
        <div style="font-weight: bold;">
            <table style="border: 0;">
                <tr style="border: 0;">
                    <th style="border: 0;">Return Invoice:</th>
                    <th style="border: 0;"> {{ $return->return_number }} </th>
                </tr>
                @if ($return->customer)
                    <tr style="border: 0;">
                        <th style="border: 0;">Customer:</th>
                        <th style="border: 0;"> {{ $return->customer->name }} </th>
                    </tr>
                @endif
                <tr style="border: 0;">
                    <th style="border: 0;">Return Date:</th>
                    <th style="border: 0;"> {{ $return->created_at->format('d/m/Y') }} </th>
                    <td style="border: 0;"></td>
                    <td style="border: 0;"></td>
                    <td style="border: 0;"></td>
                    <td style="border: 0;"></td>
                    <th style="border: 0;">Return Date:</th>
                    <th style="border: 0;"> {{ date('d/m/Y',strtotime($return->order_date)) }} </th>
                </tr>
                <tr style="border: 0;">
                    <th style="border: 0;">Cashier:</th>
                    <th style="border: 0;"> {{ $return->user->name }} </th>
                </tr>
            </table>
            {{-- التاريخ: {{$return->created_at->format('d/m/Y')}}
             <br>
             رقم الفاتورة: {{$return->order_number}}
             <br>
             الكاشير: {{$return->user->name}}
             --}}
        </div>
        <hr style="border-style: dashed;">
        <br>
        <table>
            <thead>
            <tr>
                <th class="quantity">Qty</th>
                <th></th>
                <th></th>
                <th class="price">Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($return->returnItem as $item)
                <tr>
                    <td class="quantity">{{$item->qty+0}}</td>
                    <td></td>
                    <td></td>
                    <td class="description">{{$item->product->name_en}}</td>
                </tr>
            @endforeach
            <tr style="border: 0">
                <td style="border: 0" colspan="4"></td>
            </tr>
            <tr style="border: 0">
                <td style="border: 0" colspan="4"></td>
            </tr>
            <tr style="border: 0">
                <td style="border: 0" colspan="4"></td>
            </tr>
            <tr style="font-weight: bold;">
                <td colspan="3" style="text-align: inherit;">Payed amount</td>
                <td colspan="1" {{--style="direction: ltr; text-align: center;"--}}>{{$return->amount-$return->customer_discount}}</td>
            </tr>
            </tbody>
        </table>
        <p class="centered">
            <br>
            We enjoyed your visit!
            <br><br>
            Contact us via:
            <br>Number: 01015299912</p>
    </div>
    <button id="btnPrint" class="hidden-print btn btn-success">Print</button>
    <a href="javascript:history.back()" class="hidden-print btn btn-danger">Back</a>
</center>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>
</body>
</html>
