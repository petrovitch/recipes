@extends('master')
@section('title', 'Commodities')
@section('content')

    <div class="container col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            @if ($commodities->isEmpty())
                <p> There are no commodities.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">@sortablelink ('commodity')</th>
                        <th class="text-center report-headings">@sortablelink ('Abbr')</th>
                        <th class="text-center report-headings">@sortablelink ('Test Weight')</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commodities as $commodity)
                        <tr>
                            <td class="text-left">{!! $commodity->commodity !!}</td>
                            <td class="text-center">{!! $commodity->abbr !!}</td>
                            <td class="text-right">{!! $commodity->test_weight !!}</td>
                            <td class="text-center">
                                <a href="{!! action('CommoditiesController@show', $commodity->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('CommoditiesController@edit', $commodity->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('CommoditiesController@destroy', $commodity->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $commodities->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('CommoditiesController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/commodity/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

