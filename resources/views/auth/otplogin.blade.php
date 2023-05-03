<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
            </div>
            <!-- /.login-logo -->

            <!-- /.login-box-body -->

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert"> {{session('error')}} 
                    </div>
                    @endif
                    
                    <form method="post" action="{{ route('otp.generate') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="mobile_no" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="enter mobile number"
                                class="form-control @error('mobile_no') is-invalid @enderror">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('mobile_no')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                      

                        <!-- <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Remember Me</label>
                                </div>
                            </div> -->

                            <div class="col-6">
                                <button type="submit" class="btn btn-primary">{{__('Generate OTP')}}</button>
                            </div>

                        <!-- </div> -->
                    </form>
<div>
                    <p class="mb-1">
                        <a href="{{ route('login') }}">{{__('Login with username')}}</a>
                    </p>
                    </div>
                    <!-- <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                    </p> -->
                </div>
                <!-- /.login-card-body -->
            </div>

        </div>
        <!-- /.login-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
