@extends('admin_master')
@section('admin')

    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <!--   ------------ Add Category Page -------- -->


                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Edit Subcategory')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('sub.sub.category.update',$subSubCategory->id) }}">
                                    @csrf


                                    <div class="form-group">
                                        <h5>{{__('Name in English')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" style="direction: ltr;" type="text" name="name_en"
                                                   class="form-control"
                                                   value="{{ $subSubCategory->name_en }}">
                                            @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>{{__('Name in Arabic')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" style="direction: rtl;" type="text" name="name_ar"
                                                   class="form-control"
                                                   value="{{ $subSubCategory->name_ar }}">
                                            @error('name_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Category')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="sub_category_id" class="form-control">
                                                <option value="" selected=""
                                                        disabled="">{{__('Select Category')}}</option>
                                                @foreach($subCategories as $subCategory)
                                                    <option
                                                        value="{{ $subCategory->id }}" {{ $subCategory->id == $subSubCategory->sub_category_id ? 'selected' : '' }}>{{ $subCategory->name_en }}
                                                        - {{ $subCategory->name_ar }}</option>
                                                @endforeach
                                            </select>
                                            @error('sub_category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                               value="{{__('Update')}}">
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
