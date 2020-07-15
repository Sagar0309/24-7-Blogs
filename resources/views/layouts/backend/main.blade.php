<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title','MyBlog')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('public/backend/plugins/font-awesome/css/font-awesome.min.css')}} ">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/backend/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/backend/css/skins/_all-skins.min.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/simple-mde/simplemde.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/backend/css/custom.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/css/jasny-bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend/plugins/tag-editor/jquery.tag-editor.css') }}">
  @yield('style')
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('layouts.backend.navbar')
  <!-- Left side column. contains the logo and sidebar -->
  
  @include('layouts.backend.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.6
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src=" {{ asset('public/backend/js/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/backend/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend/js/app.min.js') }}"></script>
<!-- Simple-mde editor scriptfile -->
<script src="{{ asset('public/backend/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/backend/plugins/simple-mde/simplemde.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{ asset('public/backend/plugins/css/jasny-bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<script src="{{ asset('public/backend/plugins/tag-editor/jquery.caret.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/tag-editor/jquery.tag-editor.min.js') }}"></script>
@yield('script')
</body>
</html>
