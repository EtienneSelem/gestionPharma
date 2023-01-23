<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@lang('Administration')</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}} ">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}} ">
</head>
<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Enregis</b>trement</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">@lang('Register a new membership')</p>
                <!-- Validation Errors -->
                <x-auth.validation-errors :errors="$errors" />
                
                <form class="h-add-bottom" method="POST" action="{{ route('register') }}">
                    @csrf   

                    <div class="input-group mb-3">
                        <input 
                            id="name"
                            name="name"
                            type="text" 
                            placeholder="@lang('Your name')" :value="old('name')" 
                            required 
                            autofocus 
                            autocomplete="name"
                            class="form-control" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                    </div>
                        <!-- Email Address -->
                        <x-auth.input-email />
                        
                        <!-- Password -->
                        <x-auth.input-password />

                        <div class="input-group mb-3">
                            <input 
                                id="password_confirmation" 
                                 type="password" 
                                 name="password_confirmation" 
                                 placeholder="@lang('Confirm your Password')" 
                                 required 
                                 autocomplete="new-password" 
                                 type="password" 
                                 class="form-control" 
                                 placeholder="@lang('Retype password')">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12">
                              <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                        </div>
                    </form>

                    <div class="social-auth-links text-center mb-3">
                        <p>- @lang('-----------O------------') -</p>
                    </div>
                    <!-- /.social-auth-links -->

                    <a href="login.html" class="text-center">I already have a membership</a>
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
