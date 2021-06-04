@extends('admin.layouts.app')

@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
    @endpush
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
                            <li><a href="{!! url('programs') !!}">الفرص التطوعية</a> /</li>
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
                            {!! Form::open(['url'=>url('initiatives/'.$initiative->id),'method'=>'put']) !!}


                            <div class="input-group mb-3">
                                <label class="col-md-12" for="name">عنوان الفرصة التطوعية<span class="text-danger">*</span></label>
                                <input type="text" id="name" class="form-control  @error('name') is-invalid @enderror"
                                       name="name" value="{!! $initiative->name !!}"
                                       placeholder="الاسم">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-12" for="date_start">تاريخ بداية الفرصة<span class="text-danger">*</span></label>
                                <input type="date" id="date_start" class="form-control  @error('date_start') is-invalid @enderror"
                                       name="date_start" value="{!! $initiative->date_start !!}">
                                @error('date_start')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <label class="col-md-12" for="date_end">تاريخ نهاية الفرصة<span class="text-danger">*</span></label>
                                <input type="date" id="date_end" class="form-control  @error('date_end') is-invalid @enderror"
                                       name="date_end" value="0{!! $initiative->date_end !!}">
                                @error('date_end')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <label class="col-md-12" for="program_id">اسم البرنامج الخاص بالفرصة<span class="text-danger">*</span></label>
                                <select id="program_id" name="program_id" class="form-control col-12  @error('program_id') is-invalid @enderror" >
                                    <?php
                                    $programs = \App\Models\Program::query()->get();
                                    ?>
                                        <option class="col-12">فضلا اختر الفرصة التطوعية</option>
                                    @foreach($programs as $program)
                                        <option value="{!! $program->id !!}" @if($initiative->program_id == $program->id ) selected @endif class="col-12">{!! $program->name !!}</option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {!! form::submit("تحديث",['class'=>'btn btn-primary form-control col-4']) !!}

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

