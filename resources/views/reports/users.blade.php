@extends('reports.master')
@section('content')
    <table class="table table-condensed table-striped" style="background-color:#fefefe">
        <thead>
        <tr>
            <th style="font-weight:bold;text-decoration:underline;">ID</th>
            <th style="font-weight:bold;text-decoration:underline;">Name</th>
            <th style="font-weight:bold;text-decoration:underline;">Email</th>
            <th style="font-weight:bold;text-decoration:underline;">Joined at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{!! $user->id !!}</td>
                <td>{!! $user->name !!} </td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->created_at !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

