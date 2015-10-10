@extends('master')
@section('title', 'States')
@section('content')

    <div class="container col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            @if ($states->isEmpty())
                <p> There are no states.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Abr</th>
                        <th class="text-center report-headings">State</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($states as $state)
                        <tr>
                            <td class="text-center">{!! strtoupper($state->state_abr) !!}</td>
                            <td class="text-left">{!! $state->state !!}</td>
                            <td class="text-center">
                                <a href="{!! action('StatesController@show', $state->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('StatesController@edit', $state->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('StatesController@destroy', $state->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

        <div class="text-center">{!! $states->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('StatesController@excel', $state->id) !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/state/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

