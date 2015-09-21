@extends('master')
@section('title', 'View all users')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>All users</h2>
            </div>
            @if ($users->isEmpty())
                <p>There is no user.</p>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Joined at</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{!! $user->id !!}</td>
                                <td>
                                    <a href="#">{!! $user->name !!}</a>
                                </td>
                                <td>{!! $user->email !!}</td>
                                <td>{!! $user->created_at !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}</div>
            @endif
        </div>
    </div>
@endsection