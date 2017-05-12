<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main>
        <figure id="logo">
            <img src="{{ asset('images/logo-square.svg') }}">
        </figure>
        <div id="formfield">
            <div class="form-field">
                <form role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-item">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="form-item">
                        <label>Wachtwoord</label>
                        <input id="password" type="password" class="form-control" name="password" >
                    </div>
                    <div class="form-item">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="button-field">
                            <button type="submit" class="btn green">
                                Login
                            </button>
                            <a href="{{ route('register') }}" class="btn white borderless-btn">Registreer</a>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block error">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('password'))
                        <span class="help-block error">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </form>
            </div>
        </div>




        <!--<div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" >

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="button-field">
                                        <button type="submit" class="btn green">
                                            Login
                                        </button>

                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

    </main>
</body>
</html>


