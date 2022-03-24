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
                        <div class="box-header with-border d-flex">
                            <h3 class="box-title p-2">{{__('Return Details')}}</h3>
                            <div class="ml-auto p-2">
                                <a href="{{route('print-return',$returns->id)}}"
                                   class="btn btn-warning">{{__('طباعة بالعربية')}}
                                    <i class="fa fa-print"></i>
                                </a>

                                <a href="{{route('print-return-en',$returns->id)}}"
                                   class="btn btn-warning">{{__('Print in English')}}
                                    <i class="fa fa-print"></i>
                                </a>
                            </div>
                        </div>
                        <div class="m-3 font-size-16">
                            <span class="text-danger">{{__('Date')}}:</span>
                            <b>{{$returns->created_at->format('d/m/Y')}}</b><br>
                            <span class="text-danger">{{__('Order date')}}:</span>
                            <b>{{date('d/m/Y',strtotime($returns->order_date))}}</b><br>
                            <span class="text-danger">{{__('Cashier')}}:</span> <b>{{$returns->user->name}}</b><br>
                            <span class="text-danger">{{__('Customer')}}:</span> <b>{{$returns->customer->name}}</b><br>
                            <span class="text-danger">{{__('Amount')}}:</span> <b>{{$returns->amount}}</b><br>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        {{--<th>{{__('Action')}}</th>--}}

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($returns->returnItem as $item)
                                        <tr>
                                            <td> {{app()->getLocale()=='en'?$item->product->name_en:$item->product->name_ar}}  </td>
                                            <td> {{$item->qty}}  </td>

                                            {{--<td width="25%">
                                                @if ($item->product->deleted_at != null)
                                                    <span class="text-danger">{{__('Deleted product')}}</span>
                                                @else
                                                    <a href="{{route('remove.all.items',$item->id)}}"
                                                       class="btn btn-danger" title="Delete item">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <a href="{{route('remove.item',$item->id)}}" class="btn btn-primary"
                                                       title="Remove 1">
                                                        <i class="mdi mdi-minus"></i>
                                                    </a>
                                                @endif
                                            </td>--}}
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
