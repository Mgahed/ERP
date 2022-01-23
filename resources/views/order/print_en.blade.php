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
                    <th style="border: 0;">Invoice NO: </th>
                    <th style="border: 0;"> {{ $order->order_number }} </th>
                </tr>
                <tr style="border: 0;">
                    <th style="border: 0;">Customer: </th>
                    <th style="border: 0;"> {{ $order->customer->name }} </th>
                </tr>
                <tr style="border: 0;">
                    <th style="border: 0;">Date: </th>
                    <th style="border: 0;"> {{ $order->created_at->format('d/m/Y') }} </th>
                    <td style="border: 0;"></td>
                    <td style="border: 0;"></td>
                    <td style="border: 0;"></td>
                    <td style="border: 0;"></td>
                    <th style="border: 0;">Time: </th>
                    <th style="border: 0;"> {{ $order->created_at->format('h:i A') }} </th>
                </tr>
                <tr style="border: 0;">
                    <th style="border: 0;">Cashier: </th>
                    <th style="border: 0;"> {{ $order->user->name }} </th>
                </tr>
            </table>
            {{-- التاريخ: {{$order->created_at->format('d/m/Y')}}
             <br>
             رقم الفاتورة: {{$order->order_number}}
             <br>
             الكاشير: {{$order->user->name}}
             --}}
        </div>
        <hr style="border-style: dashed;">
        <br>
        <table>
            <thead>
            <tr>
                <th class="quantity">Qty</th>
                <th class="description">Product</th>
                <th class="price">Price</th>
                <th class="price">Discount</th>
                <th class="price">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order->orderItem as $item)
                <tr>
                    <td class="quantity">{{$item->qty+0}}</td>
                    <td class="description">{{$item->product->name_en}}</td>
                    <td width="100%" class="price">{{($item->qty+0)}}*{{($item->price+0)}}</td>
                    <td width="100%" class="price">{{($item->qty+0)}}*{{($item->discount+0)}}</td>
                    <td class="price">{{$item->subtotal-(($item->qty+0)*($item->discount+0))}}</td>
                </tr>
            @endforeach
            <tr style="border: 0">
                <td style="border: 0" colspan="5"></td>
            </tr>
            <tr style="border: 0">
                <td style="border: 0" colspan="5"></td>
            </tr>
            <tr style="border: 0">
                <td style="border: 0" colspan="5"></td>
            </tr>
            @if ($order->customer_discount)
                <tr style="font-weight: bold;">
                    <td colspan="4" style="text-align: inherit;">Special discount</td>
                    <td colspan="1" {{--style="direction: ltr; text-align: center;"--}}>{{$order->customer_discount}}</td>
                </tr>
            @endif
            <tr style="font-weight: bold;">
                <td colspan="4" style="text-align: inherit;">Final total</td>
                <td colspan="1" {{--style="direction: ltr; text-align: center;"--}}>{{$order->amount-$order->customer_discount}}</td>
            </tr>
            </tbody>
        </table>
        <p class="centered">
            Purchased items can be exchanged or returned within
            <br>
            14 days from the date of purchase if the commodity has
            <br>
            a manufacturing defect in accordance with Article
            <br>
            number 8 from the Consumer Protection Law,
            <br>
            provided that they are in the same condition
            <br>
            as they were purchased.
            <br><br>
            We enjoyed your visit!
            <br><br>
            Contact us via:
            <br>Number: 01063001503</p>
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