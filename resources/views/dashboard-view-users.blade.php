<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ URL::to('css/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <script  src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')  }}" ></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('js/bootstrap.min.js') }}"> </script>

    <link rel="stylesheet" href="{{ URL::to('css/skins/skin-red.css') }}">
    <!-- jQuery UI 1.11.4 -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
{{--
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
--}}

<!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
    <!-- header -->
@include('includes.dashboard.dashboard-header')

<!-- side-bar -->
@include('includes.dashboard.dashboard-sidebar')


<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Admin Dashboard
                <small>Register Census Officials</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" style="min-height: 600px" >

            <!-- Your Page Content Here -->
            @yield('content')

            <div class="panel panel-info">
                <div class="panel-heading ">
                    <span class="glyphicon glyphicon-user"></span>
                    view users
                </div>
                <div class="panel-body">
                    <!-- ./col -->

                    <!--Register official-->

                    @if(count($errors)>0)

                        <div class="row">
                            <div class="col-md-6">

                                <ul>
                                    @foreach( $errors->all() as $error)
                                        <li class="text-danger">
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    @endif

                    <div class="col-md-8">
                        <!--display success message-->
                        @if(Session::has('alert-success'))
                            @foreach(['success'] as $msg)
                                @if(Session::has('alert-').$msg)
                                    <div class="alert alert-{{ $msg }} alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p > {{ Session::get('alert-' . $msg) }}</p>
                                    </div>
                                @endif
                            @endforeach

                        @endif
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>ID</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            <th>County</th>
                            <th>Ward</th>
                            <th>email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr >
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->phone_number }}</td>
                                @if($user->is_enumerator)
                                    <td>Enumerator</td>
                                @else
                                    <td>Census Official</td>
                                @endif

                                <td>{{ $user->county}}</td>
                                <td>{{ $user->ward }}</td>
                                <td>{{ $user->email }}</td>

                                <td>
                                    <a class="btn btn-sm btn-info"
                                       href="{{action('UserController@editUser', array('id'=> $user->id))}}">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                </td>

                                <td>
                                    <a class="btn btn-sm btn-danger"
                                       href="{{action('UserController@deleteUser', array('id'=> $user->id))}}">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--/Register official-->
            </div>

        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->


<!-- footer -->
@include('includes.dashboard.dashboard-footer')

<!-- ./wrapper -->


<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous">
</script>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::to('css/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
