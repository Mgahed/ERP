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


                                <form method="post" action="{{ route('category.store') }}">
                                    @csrf
                                    @php
                                        $carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
                                        $cartQty = \Gloudemans\Shoppingcart\Facades\Cart::count();
                                        $cartTotal = \Gloudemans\Shoppingcart\Facades\Cart::total();
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
                                            <div class="col-2"><b>{{$sum}}</b></div>
                                            <div class="col-2"></div>
                                        </div>

                                        <hr>
                                        <br>
                                        <div class="d-flex">
                                            <div class="text-left">
                                                <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                       value="{{__('Confirm')}}">
                                            </div>

                                            <div class="ml-auto">
                                                <a class="btn btn-rounded btn-danger mb-5"
                                                   href="{{route('destroy.cart')}}">{{__('Remove all')}} <i
                                                        class="fa fa-trash-o"></i></a>
                                            </div>
                                        </div>
                                    @endif
                                </form>


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
@endsection
