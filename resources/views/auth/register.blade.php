@extends('master')
@section('name', 'Register')
@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">
            <form class="form-horizontal" method="post">
                <fieldset>
                    <legend>Register an account</legend>

                    <label for="name" class="control-label">Name</label>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

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

                    <label for="password" class="text-left control-label">Confirm Password</label>
                    <div class="form-group">
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary pull-left">Submit</button>
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