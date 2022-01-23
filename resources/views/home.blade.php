@extends('admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-md-7">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Selling operation')}}</h3>
                            <form action="{{route('add.cart')}}" method="POST">
                                @csrf
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>{{__('Barcode')}}<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="barcode" autofocus required
                                                       class="form-control" autocomplete="off" id="focus">
                                                @error('barcode')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>{{__('Quantity')}}<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" min="1" tabindex="-1" name="quantity"
                                                       class="form-control" autocomplete="off" value="1" required>
                                                @error('barcode')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="text-center">
                                    <input type="submit" class="btn btn-info mb-5"
                                           value="{{__('Add')}}">
                                    {{--<button type="submit" class="btn btn-info mb-5 material-icons">{{__('Add')}} <i
                                            class="mdi mdi-cart-plus"></i></button>--}}
                                </div>
                            </form>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md -->


                <!--   ------------ Add Category Page -------- -->


                <div class="col-md-5">

                    <div class="box">
                        <div class="box-header with-border badge badge-success">
                            <h3 class="box-title" style="color: white;">{{__('Details')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
                                @php
                                    $carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
                                    $cartTotal = \Gloudemans\Shoppingcart\Facades\Cart::total();
                                    $customer = \App\Models\Customer::all();
                                    $sum = 0;
                                @endphp
                                @if ($cartTotal>0)
                                    <div class="row">
                                        <div class="col-4">{{__('Name')}}</div>
                                        <div class="col-2">{{__('Price')}}</div>
                                        <div class="col-2">{{__('Discount')}}</div>
                                        <div class="col-2">{{__('Total')}}</div>
                                        <div class="col-2">{{__('Action')}}</div>
                                    </div>
                                    <hr>
                                    @foreach ($carts as $item)
                                        <div class="row">
                                            <div class="col-4">{{$item->qty}}*{{$item->name}}</div>
                                            <div class="col-2">{{$item->qty}}*{{$item->price}}</div>
                                            <div class="col-2">{{$item->qty}}*{{$item->options->discount}}</div>
                                            <div
                                                class="col-2">{{$item->subtotal-($item->qty*$item->options->discount)}}</div>
                                            @php($sum+=$item->subtotal-($item->qty*$item->options->discount))
                                            <div class="col-2">
                                                <a href="{{route('remove.cart',$item->rowId)}}"
                                                   class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-4"><b>{{__('Total')}}</b></div>
                                        <div class="col-2"></div>
                                        <div class="col-2"></div>
                                        <div class="col-2"><b id="final_total">{{$sum}}</b></div>
                                        <div class="col-2"></div>
                                    </div>

                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="number" step="0.1" id="discount"
                                                   class="form-control" autocomplete="off" min="0" value="0"
                                                   required placeholder="{{__('Additional discount')}}">
                                        </div>
                                        <div class="col-3">
                                            <button onclick="get_discount()" class="btn btn-dark"><i
                                                    class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-9">
                                            <input list="customers" name="customer" id="customer"
                                                   class="form-control"
                                                   required placeholder="{{__('Customer number')}}">
                                            <datalist id="customers">
                                                {{--<option value="{{__('Guest')}}">--}}
                                                @foreach ($customer as $item)
                                                    <option value="{{$item->mobile}}">
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <div class="col-3 customer-name">
                                            <button onclick="get_customer()" class="btn btn-dark"><i
                                                    class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <form action="{{route('make.order')}}" method="post">
                                        @csrf
                                        <input type="hidden" id="customer_id" name="customer_id">
                                        <input type="hidden" id="customer_discount" name="customer_discount" value="0">
                                        <input type="hidden" id="sum" name="sum" value="{{$sum}}">
                                        <div class="d-flex">
                                            <div class="text-left">
                                                <input type="submit" class="btn btn-rounded btn-primary mb-5 d-none"
                                                       value="{{__('Confirm')}}">
                                            </div>

                                            <div class="ml-auto">
                                                <a class="btn btn-rounded btn-danger mb-5"
                                                   href="{{route('destroy.cart')}}">{{__('Remove all')}} <i
                                                        class="fa fa-trash-o"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>


            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    @if (Session::has('beep'))
        <script>
            var audio = new Audio('{{asset('sound/beep.mp3')}}');
            audio.play();
        </script>
    @endif
    @if (Session::has('notbeep'))
        <script>
            var audio = new Audio('{{asset('sound/incorrect.mp3')}}');
            audio.play();
        </script>
    @endif
    <script type="text/javascript">
        function get_customer() {
            var customer_number = $('input[name="customer"]').val();
            $.ajax({
                type: 'GET',
                url: "{{url('/customer/get')}}/" + customer_number,
                dataType: 'json',
                success: function (data) {
                    $('#customer_id').val(data.id);
                    $('.customer-name').html('<span class="text-danger">' + data.name + '</span>');
                    $('.d-none').removeClass('d-none');
                    $('input[name="customer"]').prop('disabled', true).css('cursor', 'not-allowed');
                },
                error: function () {
                    $('.customer-name').html('<a class="btn btn-success" href="{{route('all.customers')}}"><i class="mdi mdi-account-plus"></i></a>');
                    $('input[name="customer"]').prop('disabled', true).css('cursor', 'not-allowed');
                }
            });
        }

        function get_discount() {
            let discount = $('#discount').val();
            // alert(discount)
            let total = {{$sum}};//$('#final_total').html();
            $('#final_total').html(total - discount);
            $('#customer_discount').val(discount);
        }
    </script>
@endsection
