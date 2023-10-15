<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    
    <!-- Fonts -->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/programmeruz/laravel-creator/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/programmeruz/laravel-creator/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('vendor/programmeruz/laravel-creator/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/programmeruz/laravel-creator/css/responsive.css')}}">

</head>
<body class="antialiased">
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <form class="theme-form login-form" action="{{route('sign')}}" method="post">
                    <h4>Login</h4>
                    @csrf
                    <h6>Welcome back! Log in to your account.</h6>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                            <input class="form-control"  id="email" name="email" type="email" required="" placeholder="Test@gmail.com">
                        </div>
                        @error('email')
                        <p class='text-danger'>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group"><span class="input-group-text"><i class="icon-lock"></i></span>
                            <input class="form-control"  id="password"  type="password" name="password" required="" placeholder="*********">
                        </div>
                        @error('password')
                        <p class='text-danger'>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group mx-auto">
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
