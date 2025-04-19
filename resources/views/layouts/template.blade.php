<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Contact Book')}}</title>

  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Untuk mengirimkan token Laravel CSRF pada setiap request AJAX -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Database -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">

  <!-- Custom dark mode styles -->
  <style>
    /* Dark mode overrides */
    .dark-mode .table-bordered {
      border: 1px solid #6c757d;
    }
    .dark-mode .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(80, 80, 80, 0.2);
    }
    .dark-mode .card {
      box-shadow: 0 0 1px rgba(255, 255, 255, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
    }
    .dark-mode .table {
      color: #fff;
    }
    .dark-mode a:not(.btn) {
      color: #3f8af3;
    }
    .dark-mode .btn-default {
      background-color: #343a40;
      border-color: #6c757d;
      color: #fff;
    }
    .dark-mode .modal-content {
      background-color: #343a40;
      color: #fff;
    }
    .dark-mode .close {
      color: #fff;
      text-shadow: 0 1px 0 #000;
    }
    .dark-mode .form-control {
      background-color: #454d55;
      border-color: #6c757d;
      color: #fff;
    }
    .dark-mode .form-control:focus {
      background-color: #4b545c;
    }
    .dark-mode .page-item.disabled .page-link {
      background-color: #343a40;
      border-color: #6c757d;
    }
    .dark-mode .dataTables_wrapper .dataTables_processing {
      background-color: rgba(30, 30, 30, 0.7);
      color: #fff;
    }
    .dark-mode .dataTables_info {
      color: #fff;
    }
    .dark-mode label {
      color: #fff;
    }
    .dark-mode .dataTables_filter input {
      background-color: #454d55;
      border-color: #6c757d;
      color: #fff;
    }
    .dark-mode .dataTables_length select {
      background-color: #454d55;
      border-color: #6c757d;
      color: #fff;
    }
  </style>

  @stack('css') <!-- Digunakan untuk memanggil custom css dari perintah push css pada misig-mising view -->
</head>
<body class="hold-transition sidebar-mini dark-mode"> <!-- Added dark-mode class here -->
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.header') 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/contact-book.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Contact Book</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="adminlte/dist/img/fotogw.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Saka Nabil</a>
        </div>
      </div>

    @include('layouts.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.breadcrumb')

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- jquery-validation -->
<script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script>
  // Untuk mengirimkan token Laravel CSRF pada setiap request AJAX
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>

@stack('js')
</body>
</html>