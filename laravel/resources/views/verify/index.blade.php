@extends('layouts.app')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ action('VerifyController@check') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('uuid') ? ' has-error' : '' }}">
            <label for="uuid" class="col-md-4 control-label">Stemcode:</label>

            <div class="col-md-6">
                <input id="uuid" type="text" class="form-control" name="uuid" value="{{ old('uuid') }}" required autofocus>

                @if ($errors->has('uuid'))
                    <span class="help-block">
                        <strong>{{ $errors->first('uuid') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Opgegeven wachtwoord:</label>

            <div class="col-md-6">
                <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}" autofocus>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Controleer stem
                </button>
            </div>
        </div>
    </form>
@endsection