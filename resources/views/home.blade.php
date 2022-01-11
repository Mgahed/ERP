@extends('admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Selling operation')}}</h3>
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


                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border badge badge-success">
                            <h3 class="box-title" style="color: white;">{{__('Details')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('category.store') }}">
                                    @csrf

                                    <div class="text-center">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                               value="{{__('Confirm')}}">
                                    </div>
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
@endsection
