@extends('master')
@section('title', 'About')
@section('content')
    <div class="container">
        <div class="content">
            <div class="title">
                <h3>About</h3>
                <h4>Learning Laravel 5</h4>
                <h5>Building Practical Applications</h5>
                <h6>by Nathan Wu</h6>
                <h6>support@learninglaravel.net</h6>
                <ul>
                    <li><a href="http://learninglaravel.net/laravel5/building-a-blog-application target=_blank">Learning Laravel-5
                            Online</a></li>
                    <li><a href="https://laracasts.com/series/laravel-5-fundamentals/ target=_blank">Laracasts: Laravel
                            Fundamentals</a></li>
                    <li><a href="http://laravel.com/docs/5.1 target=_blank">Laravel Documentation</a></li>
                    <li><a href="http://laravel.io/forum target=_blank">Laravel Forum</a></li>
                </ul>
                @if(Auth::user())
                    <p>
                        User:<br>
                        <strong>{{ Auth::user()->name }}</strong><br>
                        {{ Auth::user()->email }} <br>
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
