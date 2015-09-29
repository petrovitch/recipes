@extends('master')
@section('title', 'Audit Trail')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2> Audit Trail </h2>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($audits->isEmpty())
                <p> There are no logs.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Owner Type</th>
                        <th>Owner ID</th>
                        <th>Old Value</th>
                        <th>New Value</th>
                        <th>Type</th>
                        <th>Created at</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($audits as $audit)
                        <tr>
                            <td>{!! $audit->id !!}</td>
                            <td>{!! $audit->user_id !!} </td>
                            <td>{!! $audit->owner_type !!}</td>
                            <td>{!! $audit->owner_id !!}</td>
                            <td>{!! chunk_split($audit->old_value, 30, "<br>") !!}</td>
                            <td>{!! chunk_split($audit->new_value, 30, "<br>") !!}</td>
                            <td>{!! $audit->type !!}</td>
                            <td>{!! $audit->created_at !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <center>{!! $audits->render() !!}</center>
@endsection

