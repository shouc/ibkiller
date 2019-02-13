@extends('auth.layout')

@section('content')
<div class="container">
    <body class="my-login-page">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card  top">
                <div class="card-header login_title">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-md-4">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                          <button type="submit" class="btn btn-primary  col-md-12">
                            Go!
                          </button>
                        </div>
                        
                    </form>
                    <div class="col-md-12">
                    <a href="{{ route('register') }}">
                      <button  class="btn btn-secondary  col-md-12">
                        Internal User Register
                      </button>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </body>
</div>
@endsection


