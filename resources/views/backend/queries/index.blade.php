@extends('master')
@section('title', 'Database Queries')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Database Queries</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lines as $line)
                    <tr>
                        <td>{!! $line !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<center>{!! $queries->render() !!}</center>--}}
@endsection

