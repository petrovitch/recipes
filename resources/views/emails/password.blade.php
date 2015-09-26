@extends('master')
@section('name', 'Password')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">
            <fieldset>
                <legend>Password</legend>
                Click here to reset your password: {{ url('password/reset/' . $token) }}
            </fieldset>
        </div>
    </div>
@endsection