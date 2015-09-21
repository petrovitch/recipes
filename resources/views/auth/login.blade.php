@extends('master')
@section('name', 'Login')
@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">
            <form class="form-horizontal" method="post">
                <fieldset>
                    <legend>Login</legend>

                    <label for="email" class="text-left control-label">Email</label>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="name" placeholder="Email" name="email"
                                   value="{{ old('email') }}">
                        </div>
                    </div>

                    <label for="password" class="text-left control-label">Password</label>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password" name="password"
                                   value="{{ old('password') }}">
                        </div>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me?
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </fieldset>

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                {!! csrf_field() !!}

            </form>
        </div>
    </div>
@endsection