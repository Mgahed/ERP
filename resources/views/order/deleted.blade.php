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
                            <h3 class="box-title">{{__('Deleted orders List')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Invoice no')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Cashier')}}</th>
                                        <th>{{__('Customer')}}</th>
                                        <th>{{__('Action')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $item)
                                        <tr>
                                            <td> {{ $item->created_at->format('d/m/Y h:iA') }}  </td>
                                            <td> {{ $item->order_number }}  </td>
                                            <td> {{ $item->amount }}{{__('EGP')}}  </td>
                                            <td> {{$item->user->name}}  </td>
                                            <td> {{$item->customer->name}}  </td>

                                            <td width="25%">
                                                <a href="{{ route('restore.order',$item->id) }}"
                                                   class="btn btn-success" title="Restore" id="restore">
                                                    <i class="mdi mdi-backup-restore font-size-22"></i></a>
                                                {{--<a href="{{route('delete.order',$item->id)}}" class="btn btn-danger"
                                                   title="Delete order">
                                                    <i class="fa fa-trash"></i>
                                                </a>--}}
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
