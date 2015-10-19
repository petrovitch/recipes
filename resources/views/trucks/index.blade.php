@extends('master')
@section('title', 'Trucking Companies')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($trucks->isEmpty())
                <p> There are no trucks.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">@sortablelink ('company')</th>
                        <th class="text-center report-headings">@sortablelink ('street')</th>
                        <th class="text-center report-headings">@sortablelink ('city')</th>
                        <th class="text-center report-headings">@sortablelink ('state')</th>
                        <th class="text-center report-headings">@sortablelink ('zip')</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trucks as $truck)
                        <tr>
                            <td class="text-left">{!! $truck->company !!}</td>
                            <td class="text-left">{!! $truck->street !!}</td>
                            <td class="text-left">{!! $truck->city !!}</td>
                            <td class="text-center">{!! $truck->state !!}</td>
                            <td class="text-center">{!! $truck->zip !!}</td>
                            <td class="text-center">
                                <a href="{!! action('TrucksController@show', $truck->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('TrucksController@edit', $truck->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('TrucksController@destroy', $truck->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $trucks->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('TrucksController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/truck/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

