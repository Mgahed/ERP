<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            font-size: 17px;
        }

        .outline {
            /*width: 100%;*/
            margin-left: 15px;
            margin-right: 15px;
            padding: 15px;
            /*border: 2px solid;*/
            /*border-radius: 14px;*/
        }

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
            font-size: 19px;
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
        /*@media print {
            body {
                margin: 0.03in 0.4in 0.57in 0.49in;
            }
        }*/
    </style>
    <title>Receipt example</title>
</head>
<body>
<center>
    <div class="ticket">
        <span class="centered">
            {{--<img style="width: 250px; border-radius: 20% !important; position: relative; top: -9px;"
                 src="{{asset('logo.jpeg')}}" alt="Spinel">--}}
            <span style="float: left">
                <b>{{config('app.name', 'Spinel')}}</b>
                &ensp;
                <b style="/*font-size: 18px;*/">{{$product_price+0}} LE</b>{{--0.03 - 0.4 - 0.57 - 0.49--}}
            </span>
                <img alt='Barcode Generator TEC-IT'
                     src='https://barcode.tec-it.com/barcode.ashx?data={{$barcode_gen}}&code=Code25IL&dmsize=Default'/>
                {{--<img class="outline"
                     src="data:image/png;base64, {{DNS1D::getBarcodePNG($barcode_gen, 'CODABAR')}}" alt="barcode"/>--}}
            {{--                <span style="border: 2px solid;" > {{str_pad($barcode_number, 5, "0", STR_PAD_LEFT)}} </span>--}}
                <b>{{$product_name}}</b>
            <br><br><br>
{{--            <center>{!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}</center>--}}
        </span>
    </div>
    <br><br>
    <button id="btnPrint" class="hidden-print btn btn-success">طباعة</button>
    <a href="{{url()->previous()}}" class="hidden-print btn btn-danger">رجوع</a>
</center>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>
</body>
</html>
