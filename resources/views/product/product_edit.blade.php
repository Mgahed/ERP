@extends('admin_master')
@section('admin')


    <div class="container-full">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{__('Edit Product')}} </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">

                            <form method="post" action="{{ route('product-update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <div class="row">
                                    <div class="col-12">


                                        <div class="row"> <!-- start 1st row  -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Select Category')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control" required="">
                                                            <option value="{{$product->category->id}}"
                                                                    selected="">{{$product->category->name_en}}
                                                                - {{$product->category->name_ar}}
                                                            </option>
                                                            @foreach($categories as $category)
                                                                @if ($product->category->id != $category->id)
                                                                    <option
                                                                        value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : ''}}>{{ $category->name_en }}
                                                                        - {{$category->name_ar}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Name in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input style="direction: ltr;" type="text" autocomplete="off"
                                                               name="name_en" class="form-control"
                                                               required="" value="{{$product->name_en}}">
                                                        @error('name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Name in Arabic')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input style="direction: rtl;" type="text" autocomplete="off"
                                                               name="name_ar" class="form-control"
                                                               required="" value="{{$product->name_ar}}">
                                                        @error('name_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 1st row  -->


                                        <div class="row"> <!-- start 2nd row  -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Buying Price')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off"
                                                               name="buy_price"
                                                               class="form-control"
                                                               required="" value="{{$product->buy_price}}">
                                                        @error('buy_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Selling Price')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off"
                                                               name="sell_price"
                                                               class="form-control"
                                                               required="" value="{{$product->sell_price}}">
                                                        @error('sell_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Discount Price')}}</h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off"
                                                               name="discount_price"
                                                               class="form-control"
                                                               value="{{$product->discount_price}}">
                                                        @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 2nd row  -->


                                        <div class="row"> <!-- start 3RD row  -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Barcode')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" autocomplete="off" name="barcode"
                                                               class="form-control" style="pointer-events: none;"
                                                               required="" value="{{$product->barcode}}">
                                                        @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Product Quantity')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off"
                                                               name="quantity"
                                                               class="form-control"
                                                               required="" value="{{$product->quantity}}">
                                                        @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->



                                        </div> <!-- end 3RD row  -->


                                        <br>


                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-success mb-5"
                                                   value="{{__('Update')}}">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->



    </div>


@endsection
