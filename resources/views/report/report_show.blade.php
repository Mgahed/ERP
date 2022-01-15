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
                        <div class="box-header with-border" style="display: flex;">
                            <h3 class="box-title">{{__('Report')}}</h3>
                            <button type="button" id="export_button" class="btn btn-success"
                                    style="margin: auto;">{{__('Export')}} <i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Invoice')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Profit')}}</th>
                                        <th>{{__('Cashier')}}</th>
                                        <th>{{__('Customer')}}</th>
                                        <th>{{__('Action')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $item)
                                        @php
                                            $order_item = \App\Models\OrderItem::where('order_id',$item->id)->get();
                                        @endphp
                                        @php($sum = 0)
                                        @foreach($order_item as $o_item)
                                            @php($sum+=$o_item->price_of_buy*$o_item->qty)
                                        @endforeach
                                        <tr>
                                            <td> {{ $item->created_at->format('d/m/Y h:iA') }}  </td>
                                            <td> {{ $item->order_number }}  </td>
                                            <td> {{ $item->amount }} </td>
                                            <td> {{ $item->amount-$sum }} </td>
                                            <td> {{$item->user->name}}  </td>
                                            <td> {{$item->customer->name}}  </td>
                                            <td width="25%">
                                                <a href="{{ route('view-order',$item->id) }}"
                                                   class="btn btn-info" title="Details"><i class="fa fa-eye"></i> </a>
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

    <script>
        function html_table_to_excel(type) {
            var data = document.getElementById('example1');
            var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
            XLSX.write(file, {bookType: type, bookSST: true, type: 'base64'});
            XLSX.writeFile(file, 'file.' + type);
        }

        const export_button = document.getElementById('export_button');

        export_button.addEventListener('click', () => {
            html_table_to_excel('xlsx');
        });
    </script>


@endsection
