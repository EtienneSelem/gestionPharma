<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@lang('Administration')</title>

  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}} ">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{asset('plugins/codemirror/codemirror.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/codemirror/theme/monokai.css')}}">
    <!-- SimpleMDE -->
    <link rel="stylesheet" href="{{asset('plugins/simplemde/simplemde.min.css')}}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
      <li class="nav-item d-none d-sm-inline-block">
        <form action="{{ route('logout') }}" method="POST" hidden>
            @csrf                                
          </form>
          <a class="nav-link"
              href="{{ route('logout') }}"
              onclick="event.preventDefault(); this.previousElementSibling.submit();">
              @lang('Logout')
          </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
           
       <!-- Notifications Dropdown Menu -->
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">
            @if($cartCount)
							{{ $cartCount }}
						@else
							0
						@endif
          </span>
        </a>
        @if($cartTotal)
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              @if($cartCount)
                  <span class="dropdown-item dropdown-header">{{ $cartCount }} Item(s) / SUBTOTAL: ${{ number_format($cartTotal, 2, ',', ' ') }}</span>
							@endif
              <div class="dropdown-divider"></div>
              @foreach ($content as $item)
                <a href="#" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i>  {{ $item->name }}
                  <span class="float-right text-muted text-sm">{{ $item->quantity }}x</span>${{ number_format($item->quantity * $item->price, 2, ',', ' ') }}</span>
                </a>
              @endforeach
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">Commandé</a>
            </div>
        @endif
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin')}} " class="brand-link">
      <img src=""  class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{auth()->user()->name}}  </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
          @foreach(config('menu') as $name => $elements)
          @if($elements['role'] === 'redac' || auth()->user()->isAdmin())
              @isset($elements['children'])
                  <li class="nav-item has-treeview {{ menuOpen($elements['children']) }}">
                      <a href="#" class="nav-link {{ currentChildActive($elements['children']) }}">
                          <i class="nav-icon fas fa-{{ $elements['icon'] }}"></i>
                          <p>
                              @lang($name)
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @foreach($elements['children'] as $child)
                              @if(($child['role'] === 'redac' || auth()->user()->isAdmin()) && $child['name'] !== 'fake')
                                  <x-back.menu-item 
                                      :route="$child['route']" 
                                      :sub=true>
                                      @lang($child['name'])
                                  </x-back.menu-item>
                              @endif
                          @endforeach
                      </ul>
                  </li>
              @else
                  <x-back.menu-item 
                      :route="$elements['route']" 
                      :icon="$elements['icon']">
                      @lang($name)
                  </x-back.menu-item>
              @endisset
          @endif
      @endforeach


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="color: #fff" class="m-0 text-dark">@lang($title)</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        @yield('main')

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
<!-- Bootstrap -->
<script src=" {{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}} "></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard2.js')}} "></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>


@yield('js')
</body>
</html>
