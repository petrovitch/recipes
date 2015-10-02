@extends('master')
@section('title', 'Database Queries')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Query</th>
                </tr>
                </thead>
                <tbody>
                @foreach($queries as $query)
                    <tr>
                        <td>{!! $query["query"] !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<center>{!! $queries->render() !!}</center>--}}
@endsection

