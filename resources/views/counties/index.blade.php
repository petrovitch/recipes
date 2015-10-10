@extends('master')
@section('title', 'Counties')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($counties->isEmpty())
                <p> There are no counties.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">County</th>
                        <th class="text-center report-headings">Label</th>
                        <th class="text-center report-headings">Locale</th>
                        <th class="text-center report-headings">State ID</th>
                        <th class="text-center report-headings">State</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($counties as $county)
                        <tr>
                            <td class="text-left">{!! $county->county !!}</td>
                            <td class="text-left">{!! $county->label !!}</td>
                            <td class="text-left">{!! $county->locale !!}</td>
                            <td class="text-right">{!! $county->state_id !!}</td>
                            <td class="text-left">{!! $county->state->state !!}</td>
                            <td class="text-center">
                                <a href="{!! action('CountiesController@show', $county->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('CountiesController@edit', $county->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('CountiesController@destroy', $county->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $counties->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('CountiesController@excel', $county->id) !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/county/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

