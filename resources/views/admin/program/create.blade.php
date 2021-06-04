@extends('admin.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{!! $title !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! url("") !!}">الرئيسية</a> /</li>
                            <li><a href="{!! url('programs') !!}">المجموعات</a> /</li>
                            <li class="breadcrumb-item active">{!! $title !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body register-card-body col-md-6" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['url'=>url('programs')]) !!}

                            <div class="input-group mb-3">
{{--                                <label class="col-md-12" for="name">اسم المجموعة<span class="text-danger">*</span></label>--}}
                                <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror"
                                       name="name" value="{!! old('name') !!}"
                                       placeholder="اسم المجموعة التطوعية" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {!! Form::submit("حفظ",['class'=>'btn btn-primary form-control col-md-4']) !!}

                            {!! Form::close() !!}
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @push('jQuery')



    @endpush

@endsection

