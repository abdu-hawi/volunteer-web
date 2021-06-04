<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{!! $title ?? (setting()->main_lang=='ar'?setting()->site_name_ar:setting()->site_name_en) !!}</title>

    <link rel="icon" href="{!! Storage::url('storage/'.setting()->icon) !!}" type="image/x-icon">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{!! asset('/design/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('/design/dist/css/adminlte.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('/design/dist/css/bootstrap-RTL-4.1.1.css') !!}">
    <link rel="stylesheet" href="{!! asset('/design/dist/css/app.style.css') !!}">
    @stack('css')
    <link rel="stylesheet" href="{!! asset('/design/dist/css/dashboard-style-ar.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    {{--    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>--}}
    {{--    <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase.js"></script>--}}
    <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.1/firebase-messaging.js"></script>
    {{--
    <script>
        var firebaseConfig = {
            // apiKey: "XXXX",
            // authDomain: "XXXX.firebaseapp.com",
            // databaseURL: "https://XXXX.firebaseio.com",
            // projectId: "XXXX",
            // storageBucket: "XXXX",
            // messagingSenderId: "XXXX",
            // appId: "XXXX",
            // measurementId: "XXX",
            apiKey: "AIzaSyCFos_kBExAr3ZAhEoh5ga45LwJNKVkzBs",
            authDomain: "voluntary-programs.firebaseapp.com",
            databaseURL: "https://voluntary-programs.firebaseio.com",
            projectId: "voluntary-programs",
            storageBucket: "voluntary-programs.appspot.com",
            messagingSenderId: "862334564636",
            appId: "1:862334564636:web:3fec5651ab3cae22e1a2d9"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();
        function initFirebaseMessagingRegistration() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function(token) {
                    console.log(token);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("save-token") }}',
                        type: 'POST',
                        data: {
                            token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            alert('Token saved successfully.');
                        },
                        error: function (err) {
                            console.log('User Chat Token Error'+ err);
                        },
                    });
                }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
        }
        messaging.onMessage(function(payload) {
            const noteTitle = payload.notification.title;
            const noteOptions = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(noteTitle, noteOptions);
        });
    </script>
--}}
    <link rel="manifest" href="manifest.json">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            {{--        <li class="nav-item d-none d-sm-inline-block">--}}
            {{--            <a href="{!! url("") !!}" class="nav-link">مشاهدة الموقع</a>--}}
            {{--        </li>--}}
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                    </x-jet-dropdown-link>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{!! url('') !!}" class="brand-link">
            @if(!empty(setting()->icon))
                <img src="{!! Storage::url('storage/'.setting()->icon) !!}" alt="مبادرة مليون متطوع" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">{!! \Illuminate\Support\Facades\Auth::user()->name !!}</span>
            @else
                <span class="brand-text font-weight-light"><b>{!! \Illuminate\Support\Facades\Auth::user()->name !!}</b></span>
            @endif
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
        {{--        <div class="user-panel mt-3 pb-3 mb-3 d-flex">--}}
        {{--            <div class="info">--}}
        {{--                <a href="#" class="d-block">Bader</a>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->


                    {{--                <li class="nav-item">--}}
                    {{--                    <a href="{!! url('/dashboard') !!}" class="nav-link ">--}}
                    {{--                        <i class="nav-icon fas fa-tachometer-alt"></i>--}}
                    {{--                        <p>--}}
                    {{--                            Dashboard--}}
                    {{--                        </p>--}}
                    {{--                    </a>--}}
                    {{--                </li>--}}

                    <li class="nav-item">
                        <a href="{!! url('programs') !!}" class="nav-link {!! active_menu('programs')[0] !!}">
                            <i class="nav-icon fas fa-hand-holding-heart"></i>
                            <p>
                                البرامج
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{!! url('initiatives') !!}" class="nav-link {!! active_menu('initiatives')[0] !!}">
                            <i class="nav-icon fas fa-hands-helping"></i>
                            <p>
                                الفرص التطوعية
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{!! url("volunteers") !!}" class="nav-link {!! active_menu('volunteers')[0] !!}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                المتطوعين
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{!! url('settings') !!}" class="nav-link {!! active_menu('settings')[0] !!}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                الاعدادات
                            </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center>
                    <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
                </center>
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('send.notification') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">

        </div>
        <!-- Default to the left -->
        <strong>جميع الحقوق محفوظة @ 2020</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- jQuery -->
<script src="{!! asset('/design/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('/design/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('/design/dist/js/adminlte.min.js') !!}"></script>
<script src="{!! asset('/js/firebase.js') !!}"></script>

</body>
</html>

