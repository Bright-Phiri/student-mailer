<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-md-7 col-sm-9 m-auto">
                <div class="card mt-5">
                    <div class="card-header bg-transparent">
                        <h5>Reset Password</h5>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                         <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                          <label for="email">{{ __('E-Mail Address') }}</label>
                          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                            <a class="float-right pt-3" href="{{ route('login') }}">Login</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
