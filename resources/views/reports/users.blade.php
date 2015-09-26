@extends('reports.master')
@section('content')
    <table class="table table-striped" style="background-color:white">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Joined at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->id !!}</td>
                <td>
                    <a href="{!! action('Admin\UsersController@edit', $user->id) !!}">{!! $user->name !!} </a>
                </td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->created_at !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

