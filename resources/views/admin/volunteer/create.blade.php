@extends('admin.layouts.app')


@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
@endpush

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
                            <li><a href="{!! url('programs') !!}">المتطوعون</a> /</li>
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
                            {!! Form::open(['url'=>url('volunteers')]) !!}

                            <div class="input-group mb-3">
                                <label class="col-md-12" for="name">اسم المتطوع<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror"
                                       name="name" value="{!! old('name') !!}" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-12" for="age">العمر<span class="text-danger">*</span></label>
                                <input type="number" id="age" class="form-control  @error('age') is-invalid @enderror"
                                       name="age" value="{!! old('age') !!}" />
                                @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-12" for="mobile">رقم الجوال<span class="text-danger">*</span></label>
                                <input type="number" id="mobile" class="form-control  @error('mobile') is-invalid @enderror"
                                       name="mobile" value="{!! old('mobile') !!}" />
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-12" for="gender">الجنس<span class="text-danger">*</span></label>
                                <select id="gender" name="gender" class="form-control  @error('gender') is-invalid @enderror">
                                    <option selected>فضلا أختر الجنس</option>
                                    <option value="male" @if(old('gender') == "male") selected @endif>ذكر</option>
                                    <option value="female" @if(old('gender') == "female") selected @endif>أنثى</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-12" for="national_id">رقم الهوية<span class="text-danger">*</span></label>
                                <input type="text" id="national_id" class="form-control  @error('national_id') is-invalid @enderror"
                                       name="national_id" value="{!! old('national_id') !!}" />
                                @error('national_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <select id="program" class="form-control col-12  @error('program') is-invalid @enderror" multiple >
                                    <?php
                                    $programs = \App\Models\Program::query()->get();
                                    ?>
                                    @foreach($programs as $program)
                                        <option value="{!! $program->id !!}" @if(old('program') == $program->id ) selected @endif class="col-12">{!! $program->name !!}</option>
                                    @endforeach
                                </select>


                                @error('program')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input type="hidden" name="program" id="program_select" value="{!! old("program_select") !!}">
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


    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

        <script>
            $('#program').multiselect({
                nonSelectedText: 'فضلا أختر البرامج التطوعية المراد الاشتراك بها',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                maxHeight: '1000',
                buttonWidth: '400',
                onChange: function(element, checked) {
                    var brands = $('#program option:selected');
                    var selected = [];
                    $(brands).each(function(index, brand){
                        selected.push([$(this).val()]);
                    });
                    $('#program_select').val(selected);
                }
            });
        </script>
    @endpush

@endsection

