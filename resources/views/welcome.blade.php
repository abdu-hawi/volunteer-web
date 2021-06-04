@extends('admin.layouts.app_login')
@section('content')




    <div class="login-box col-12">
        <div class="login-logo">
            <img src="{!! asset('/design/image/logo-5-dec.png') !!}" title="" class="" height="400">
        </div>
        <!-- /.login-logo -->
        <div class="col-12" style="margin-top: 7rem; margin-right: auto; margin-left: auto;">
            <a href="{!! url('login') !!}" ><button class="btn btn-info form-control">تسجيل الدخول</button> </a>
        </div>
    </div>
    <!-- /.login-box -->
@stop
