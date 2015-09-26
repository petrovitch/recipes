@extends('master')
@section('name', 'Password Reset')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">
            <fieldset>
                <legend>Password Reset</legend>
                <form method="POST" action="/password/reset">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email" class="col-lg-3 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <label for="password" class="col-lg-4 control-label">Password</label>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password" name="password"
                                   value="{{ old('password') }}">
                        </div>
                    </div>

                    <label for="password" class="col-lg-4 control-label">Confirm Password</label>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="col-lg-10">
                        <br>
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
@endsection