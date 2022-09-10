@extends('admin_master')
@section('admin')
    @php
        $carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $cartTotal = \Gloudemans\Shoppingcart\Facades\Cart::total();
        $customer = \App\Models\Customer::all();
        $sum = 0;
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <!-- Modal -->
    <div class="modal center-modal fade" id="modal-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add customer')}}</h5>
                    <button onclick="dismiss()" type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('customer.store')}}" method="post">
                        <div class="controls">
                            <div class="form-group">
                                <h5>{{__('Name')}}<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name"
                                           class="form-control" autocomplete="off">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <h5>{{__('Mobile')}}<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="mobile"
                                           class="form-control" autocomplete="off">
                                    @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" name="modal_discount" id="modal_discount"
                                           class="form-control" autocomplete="off">
                                    <input type="hidden" name="modal_customer" id="modal_customer"
                                           class="form-control" autocomplete="off">
                                    <input type="hidden" name="modal_final_total" id="modal_final_total"
                                           class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <br>
                        @csrf
                        <input type="submit" class="btn btn-rounded btn-primary float-right" value="{{__('Save')}}">
                    </form>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button onclick="dismiss()" type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">
                        {{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-md-5">

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
                                    <input type="submit" class="btn btn-info mb-5" style="display: none;"
                                           value="{{__('Add')}}">
                                    {{--<button type="submit" class="btn btn-info mb-5 material-icons">{{__('Add')}} <i
                                            class="mdi mdi-cart-plus"></i></button>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md -->


                <!--   ------------ Add Category Page -------- -->


                <div class="col-md-7">

                    <div class="box">
                        <div class="box-header with-border badge badge-success">
                            <h3 class="box-title" style="color: white;">{{__('Details')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive-lg">
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
                                        <div class="col-2"><b
                                                id="final_total">{{Session::has('order_page_data')?Session::get('order_page_data')['modal_final_total']:$sum}}</b>
                                        </div>
                                        <div class="col-2"></div>
                                    </div>

                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="number" step="0.1" id="discount"
                                                   value="{{Session::has('order_page_data')?Session::get('order_page_data')['modal_discount']:'0'}}"
                                                   class="form-control" autocomplete="off" min="0"
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
                                                   @if (Session::has('number')) value="{{Session::get('number')}}"
                                                   @elseif (Session::has('order_page_data'))
                                                   value="{{Session::get('order_page_data')['modal_customer']}}"
                                                   @endif
                                                   required placeholder="{{__('Customer number')}}" autocomplete="off">
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
                                    <hr>
                                    <!-- /.box-header -->
                                    @if ($cartTotal>0)
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="text-center">{{__('Payed')}}</h4>
                                                <input onkeyup="get_remained()" type="number" step="0.1"
                                                       id="remain_input"
                                                       class="form-control" autocomplete="off" min="0"
                                                       required placeholder="0.00">
                                            </div>
                                            {{--<div class="col-2">
                                                <button onclick="get_remained()" class="btn btn-primary"><i
                                                        class="fa fa-check"></i></button>
                                            </div>--}}
                                            <div class="col-5">
                                                <h4 class="text-center">{{__('Remains')}}</h4>
                                                <input style="width: 100%" id="remained" type="number" disabled
                                                       value="0">
                                            </div>
                                            <br><br>
                                        </div>
                                    @endif
                                    {{--<center>
                                    <span class="text-danger d-none" id="span_remained">{{__('Remains')}} <b
                                            id="remained"></b></span>
                                    </center--}}
                                <!-- /.box-body -->
                                    <br>
                                    <form action="{{route('make.order')}}" method="post">
                                        @csrf
                                        <input type="hidden" id="customer_id" name="customer_id">
                                        <input type="hidden" id="customer_discount" name="customer_discount" value="0">
                                        <input type="hidden" id="sum" name="sum" value="{{$sum}}">
                                        <br>
                                        <input type="text" id="customer_number" name="customer_number" class="form-control d-none" required value="null" style="pointer-events: none;">
                                        <br>
                                        <input autocomplete="off" type="text" id="customer_name" name="customer_name" class="form-control d-none" required placeholder="{{__('Customer name')}}" value="null">
                                        <br>
                                        <div class="d-flex">
                                            <div class="text-left">
                                                <input id="confirm" type="submit"
                                                       class="btn btn-rounded btn-primary mb-5 d-none"
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
            if(customer_number === ''){
                customer_number = '0123456789';
            }
            $.ajax({
                type: 'GET',
                url: "{{url('/customer/get')}}/" + customer_number,
                dataType: 'json',
                success: function (data) {
                    $('#customer_id').val(data.id);
                    $('.customer-name').html('<span class="text-danger">' + data.name + '</span>');
                    $('.d-none').removeClass('d-none');
                    $('#customer_number').hide();
                    $('#customer_name').hide();
                    $('input[name="customer"]').prop('disabled', true).css('cursor', 'not-allowed');

                    $('#confirm').click(function () {
                        $('#confirm').css('pointer-events', 'none');
                    });
                },
                error: function () {
                    $('.customer-name').hide();
                    $('#customer_number').val(customer_number);
                    $('#customer_name').val('');
                    $('.d-none').removeClass('d-none');
                    $('#confirm').click(function () {
                        $('#confirm').css('pointer-events', 'none');
                    });
                    $('#customer_name').keyup(function () {
                        $('#confirm').css('pointer-events', 'auto');
                    })
                    //$('.customer-name').html('<button onclick="openModal()" type="button" class="btn btn-success" data-target="#modal-center"> <i class="mdi mdi-account-plus"></i> </button>');
                    //$('input[name="customer"]').prop('disabled', true).css('cursor', 'not-allowed');
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

        function get_remained() {
            let payed = $('#remain_input').val();
            let total = $('#final_total').html();
            $('#remained').val(payed - total);
            // $('#span_remained').removeClass('d-none');
        }

        function openModal() {
            let number = $('#customer').val();
            $('input[name="mobile"]').val(number);
            $('#modal-center').modal('show');

            let discount = $('#discount').val();
            let customer = $('#customer').val();
            let final_total = $('#final_total').text();

            $("#modal_discount").val(discount);
            $("#modal_customer").val(customer);
            $("#modal_final_total").val(final_total);
        }

        function dismiss() {
            $('#modal-center').modal('hide');
            $('#modal-center-product').modal('hide');
        }
    </script>
@endsection
