<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@lang('Pharmacie De la paix')</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}} ">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}} ">
</head>
<body class="hold-transition login-page">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Logi</b>n</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <!-- Validation Errors -->
                <x-auth.validation-errors :errors="$errors" />
                <!-- Session Status -->
                <x-auth.session-status :status="session('status')" />

                <form class="h-add-bottom" method="POST" action="{{ route('login') }}">
                    @csrf   
                        <!-- Email Address -->
                        <x-auth.input-email />
                        
                        <!-- Password -->
                        <x-auth.input-password />

                        <div class="row">
                            <div class="col-7">
                                <div class="icheck-primary">
                                    <input 
                                        id="remember" 
                                        type="checkbox" 
                                        name="remember" 
                                        {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    @lang('Remember me')
                                </label>
                                </div>
                            </div>
                            <!-- /.col -->
                              <x-auth.submit title="Login" />
                            <!-- /.col -->
                        </div>
                    </form>

                    <div class="social-auth-links text-center mb-3">
                        <p>- @lang('----------O----------') -</p>
                        @guest

                        @else

                        @if(auth()->user()->role != 'user')
                            <div class="col-12">
                                <a href="{{ url('admin') }} " class="btn btn-info btn-block">@lang('Administration')</a>
                            </div> 
                        @endif
                            

                        @endguest
                    </div>
                    <!-- /.social-auth-links -->

                    <p class="mb-1">
                        <a href="forgot-password.html">@lang('I forgot my password')</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{route('register')}}" class="text-center">@lang('Register a new membership')</a>
                    </p>
                    
                </div>
                <!-- /.login-card-body -->
            </div>
    </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
