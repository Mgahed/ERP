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
                            <h3 class="box-title">{{__('Deleted products List')}} <span
                                    class="badge badge-pill badge-danger"> {{ count($products) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Barcode')}}</th>
                                        <th>{{__('Product name')}}</th>
                                        <th>{{__('Buying price')}}</th>
                                        <th>{{__('Selling price')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Discount')}}</th>
                                        <th>{{__('Action')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $item)
                                        <tr>
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


                                            <td width="30%">

                                                <a href="{{ route('product.restore',$item->id) }}" class="btn btn-success"
                                                   title="Restore" id="restore">
                                                    <i class="mdi mdi-backup-restore font-size-22"></i></a>


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
