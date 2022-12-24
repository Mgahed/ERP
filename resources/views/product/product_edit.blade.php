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
                                                        <select id="categoryId" name="category_id" class="form-control"
                                                                required="">
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
                                                    <h5>{{__('Select Subcategory')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <select id="sub_category_id" name="sub_category_id"
                                                                class="form-control" required="">
                                                            <option value="{{$product->subCategory->id ?? null}}"
                                                                    selected="">{{$product->subCategory->name_en ?? ''}}
                                                                - {{$product->subCategory->name_ar ?? ''}}
                                                            </option>
                                                        </select>
                                                        @error('sub_category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Select Sub Subcategory')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <select name="sub_sub_category_id" id="sub_sub_category_id"
                                                                class="form-control" required="">
                                                            <option value="{{$product->subSubCategory->id ?? null}}"
                                                                    selected="">{{$product->subSubCategory->name_en ?? ''}}
                                                                - {{$product->subSubCategory->name_ar ?? ''}}
                                                            </option>
                                                        </select>
                                                        @error('sub_sub_category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 1st row  -->


                                        <div class="row">
                                            <div class="col-md-6">
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


                                            <div class="col-md-6">
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
                                        </div>


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
                                                        <input id="selling_price" type="number" step="0.01"
                                                               autocomplete="off"
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
                                                    <div id="discount" class="controls" style="display: none;">
                                                        <input onkeyup="discountPrice(this)" type="number" min="0"
                                                               step="0.01" autocomplete="off"
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
                                                               class="form-control"
                                                               {{--style="pointer-events: none;"--}}
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


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Product discount percentage')}}
                                                    </h5>
                                                    <div id="percentage" class="input-group controls"
                                                         style="display: none;">
                                                        <input onkeyup="percentages(this)" type="number" min="0"
                                                               step="0.01" name="percentage"
                                                               autocomplete="off"
                                                               class="form-control" value="">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 3RD row  -->

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Image')}}
                                                    </h5>
                                                    <div id="percentage" class="input-group controls">
                                                        <input type="file" accept="image/png, image/jpeg" name="image"
                                                               autocomplete="off" class="form-control">
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Tax')}}
                                                    </h5>
                                                    <div id="percentage" class="input-group controls">
                                                        <input type="number" min="0"
                                                               step="0.01" name="tax"
                                                               autocomplete="off"
                                                               class="form-control" value="{{$product->tax}}">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-percent"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end col md 4 -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Description')}} {{__('In English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea type="text" autocomplete="off" name="description"
                                                                  class="form-control"
                                                                  required>{{$product->description_en}}</textarea>
                                                        @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Description_ar')}} {{__('In Arabic')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea type="text" autocomplete="off" name="description_ar"
                                                                  class="form-control"
                                                                  required>{{$product->description_ar}}</textarea>
                                                        @error('description_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>

                                        </div>


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

    <script src="{{asset('js/jquery.js')}}"></script>
    <script>
        let intervalID = window.setInterval(() => {
            if ($('#selling_price').val() > 0) {
                $('#discount').show();
                $('#percentage').show();
            } else {
                $('#discount').hide();
                $('#percentage').hide();
            }
        }, 700);

        function percentages(elem) {
            let selling_price = $('#selling_price').val()
            let percentage = $(elem).val();
            $('input[name="discount_price"]').val(selling_price - (selling_price * percentage / 100))
        }

        function discountPrice(elem) {
            let selling_price = $('#selling_price').val()
            let discount_price = $(elem).val();
            if (discount_price) {
                $('input[name="percentage"]').val(100 - (discount_price / selling_price * 100))
            } else {
                $('input[name="percentage"]').val(0)
            }
        }

        setTimeout(() => {
            discountPrice($('input[name="discount_price"]'));
        }, 900);

        // make ajax request to get sub categories
        $('#categoryId').on('change', function () {
            let category_id = $(this).val();
            $.ajax({
                url: "{{route('getSubCategories')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    category_id: category_id
                },
                success: function (data) {
                    $('#sub_category_id').html(data);
                }
            })
        });

        // make ajax request to get sub sub categories
        $('#sub_category_id').on('change', function () {
            let sub_category_id = $(this).val();
            $.ajax({
                url: "{{route('getSubSubCategories')}}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                    sub_category_id: sub_category_id
                },
                success: function (data) {
                    console.log(data)
                    $('#sub_sub_category_id').html(data);
                }
            })
        });
    </script>
@endsection
