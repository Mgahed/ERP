{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() === 'en' ? 'ltr' : 'rtl'}}">
<head>
    {{--    pwa--}}
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <link rel="apple-touch-icon" href="{{asset('images/96x96.png')}}">
    <meta name="theme-color" content="#027B9A"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#004658">
    <meta name="apple-mobile-web-app-title" content="Kiki Riki">
    {{--    End pwa--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('logo.jpeg')}}">

    <title>{{ config('app.name', 'Laravel') }} | {{__('Login')}}</title>

    @if (app()->getLocale() === 'en')

    <!-- Vendors Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/vendors_css.css')}}">

        <!-- Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/skin_color.css')}}">
    @else
    <!-- Vendors Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/rtl_vendors_css.css')}}">

        <!-- Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/rtl.css')}}">
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/rtl_skin_color.css')}}">
    @endif

</head>
<body class="hold-transition theme-primary bg-gradient-primary">

<div class="container h-p100">
    <div class="row align-items-center justify-content-md-center h-p100">

        <div class="col-12">
            <div class="row justify-content-center no-gutters">
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="content-top-agile p-10">
                        <img style="width: 200px; border-radius: 20% !important; position: relative; top: -9px;"
                             src="{{asset('logo.jpeg')}}" alt="Kiki Riki">
                        <p class="text-white-50">{{__('Sign in')}}</p>
                    </div>
                    <div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text"
                                           class="form-control pl-15 bg-transparent text-white plc-white @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" autocomplete="off" placeholder="{{__('Username')}}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text  bg-transparent text-white"><i
                                                class="ti-lock"></i></span>
                                    </div>
                                    <input type="password"
                                           class="form-control pl-15 bg-transparent text-white plc-white @error('password') is-invalid @enderror"
                                           name="password"
                                           placeholder="{{__('Password')}}" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-info btn-rounded mt-10">{{__('Sign in')}}</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Vendor JS -->
<script src="{{asset('admin-dashboard/js/vendors.min.js')}}"></script>
<script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('{{asset('sw.js')}}')
            .then(reg => console.log('sw registerd', reg))
            .catch(err => console.log('sw registerd error', err))
    }
</script>
</body>
</html>

