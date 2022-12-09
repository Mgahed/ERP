@extends('admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Product List')}} <span
                                    class="badge badge-pill badge-danger"> {{ count($products) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{__('Image')}}</th>
                                        <th>{{__('Barcode')}}</th>
                                        <th>{{__('Product name')}}</th>
                                        <th>{{__('Buying price')}}</th>
                                        <th>{{__('Selling price')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Discount')}}</th>
                                        <th>{{__('Tax')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Subcategory')}}</th>
                                        <th>{{__('Action')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $item)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->name_en }}"
                                                     style="width: 50px; height: 50px;">
                                            <td>{{ $item->barcode }}</td>
                                            <td>{{ $item->name_en }} - {{ $item->name_ar }}</td>
                                            <td>{{ $item->buy_price }} {{__('EGP')}}</td>
                                            <td>{{ $item->sell_price }} {{__('EGP')}}</td>
                                            <td>{{ $item->quantity }}</td>

                                            <td>
                                                @if($item->discount_price == NULL)
                                                    <span class="badge badge-pill badge-danger">{{__('No Discount')}}</span>
                                                @else
                                                    @php
                                                        $amount = $item->sell_price - $item->discount_price;
                                                        $discount = ($amount/$item->sell_price) * 100;
                                                    @endphp
                                                    <span class="badge badge-pill badge-danger">{{ round($discount)  }} %</span>

                                                @endif


                                            </td>
                                            <td>
                                                @if($item->tax == NULL)
                                                    <span class="badge badge-pill badge-danger">{{__('No Tax')}}</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">{{ $item->tax }} %</span>
                                                @endif
                                            </td>

                                            <td>{{ $item->category->name_en }} - {{$item->category->name_ar}}</td>
                                            <td>{{ $item->subCategory->name_en ?? '' }} - {{$item->subCategory->name_ar ?? ''}}</td>


                                            <td width="30%">
                                                <a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary"
                                                   title="Product Details Data"><i class="fa fa-eye"></i> </a>

                                                <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info"
                                                   title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                                <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger"
                                                   title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>

                                                <a href="{{ route('barcode',$item->id) }}" class="btn btn-default"
                                                   title="Barcode">
                                                    <i class="fa fa-barcode"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col -->


            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>




@endsection
