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
                            <h3 class="box-title">{{__('Category List')}} <span
                                    class="badge badge-pill badge-danger"> {{ count($category) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Name in English')}}</th>
                                        <th>{{__('Name in Arabic')}}</th>
                                        <th>{{__('Actions')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($category as $item)
                                        <tr>
                                            <td>{{ $item->name_en }}</td>
                                            <td>{{ $item->name_ar }}</td>
                                            <td>
                                                <a href="{{ route('category.edit',$item->id) }}" class="btn btn-info"
                                                   title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                                {{--<a href="{{ route('category.delete',$item->id) }}"
                                                   class="btn btn-danger" title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>--}}
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
                <!-- /.col-md -->


                <!--   ------------ Add Category Page -------- -->


                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border badge badge-success">
                            <h3 class="box-title" style="color: white;">{{__('Add Category')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('category.store') }}">
                                    @csrf


                                    <div class="form-group">
                                        <h5>{{__('Name in English')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" style="direction: ltr;" name="name_en"
                                                   class="form-control" autocomplete="off">
                                            @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>{{__('Name in Arabic')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" style="direction: rtl;" name="name_ar"
                                                   class="form-control" autocomplete="off">
                                            @error('name_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                               value="{{__('Add')}}">
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
