@extends('admin.layouts.app_login')
@section('content')




    <div class="login-box col-sm-12">
            <div class="login-logo">
                <img src="{!! asset('/design/image/logo-5-dec.png') !!}" title="" class="" height="200">
            </div>
    <!-- /.login-logo -->
        <div class="card">
            <div class="card-header" >
                تسجيل الدخول
            </div>
            <div class="card-body login-card-body">
                @if (session()->has('error_login'))
                    <div class="alert alert-danger">
                        {!! session('error_login') !!}
                    </div>
                @endif
                <form action="" method="post">
                    {!! csrf_field() !!}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="البريد الالكتروني" value="{!! old('email') !!}">
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <span class="fas fa-envelope"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="كلمة المرور">
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <span class="fas fa-lock"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
{{--                        <div class="col-8">--}}
{{--                            <div class="icheck-primary">--}}
{{--                                <input type="checkbox" name="remember" id="remember" {!! old('remember') == 'on'?'checked':'' !!} >--}}
{{--                                <label for="remember">--}}
{{--                                    تذكرني--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-gold btn-block">تسجيل الدخول</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@stop
