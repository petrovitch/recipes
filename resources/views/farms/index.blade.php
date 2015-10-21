@extends('master')
@section('title', 'Farm')
@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($farms->isEmpty())
                <p> There are no farms.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">@sortablelink ('farm')</th>
                        <th class="text-center report-headings">@sortablelink ('acres')</th>
                        <th class="text-center report-headings">County</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($farms as $farm)
                        <tr>
                            <td class="text-left">{!! $farm->farm !!}</td>
                            <td class="text-right" style="width:100px">{!! $farm->acres !!}</td>
                            <td class="text-right" style="width:100px">{!! getCounty($farm->county_id) !!}</td>
                            <td class="text-center">
                                <a href="{!! action('FarmsController@show', $farm->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('FarmsController@edit', $farm->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('FarmsController@destroy', $farm->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $farms->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('FarmsController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/farm/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

