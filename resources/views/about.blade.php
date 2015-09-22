@extends('master')
@section('title', 'About')
@section('content')
    <div class="container">
        <div class="content">
            <div class="title">
                <h3>About</h3>
                @if(Auth::user())
                <strong>{{ Auth::user()->name }}</strong><br>
                {{ Auth::user()->email }}
                @endif
            </div>
        </div>
    </div>
@endsection
