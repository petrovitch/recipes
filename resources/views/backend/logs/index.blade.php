@extends('master')
@section('title', 'Audit Trail')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Audit Trail </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($users->isEmpty())
                <p> There are no logs.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Owner Type</th>
                        <th>Old Value</th>
                        <th>New Value</th>
                        <th>Type</th>
                        <th>Created at</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{!! $log->id !!}</td>
                            <td>{!! $log->user_id !!} </td>
                            <td>{!! $log->owner_type !!}</td>
                            <td>{!! $log->old_value !!}</td>
                            <td>{!! $log->new_value !!}</td>
                            <td>{!! $log->type !!}</td>
                            <td>{!! $log->created_at !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <center>{!! $logs->render() !!}</center>
@endsection

