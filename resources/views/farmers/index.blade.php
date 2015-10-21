@extends('master')
@section('title', 'Farmers')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($farmers->isEmpty())
                <p> There are no farmers.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">@sortablelink ('farmer')</th>
                        <th class="text-center report-headings">@sortablelink ('street')</th>
                        <th class="text-center report-headings">@sortablelink ('city')</th>
                        <th class="text-center report-headings">@sortablelink ('state')</th>
                        <th class="text-center report-headings">@sortablelink ('zip')</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($farmers as $farmer)
                        <tr>
                            <td class="text-left">{!! $farmer->customer !!}</td>
                            <td class="text-left">{!! $farmer->street !!}</td>
                            <td class="text-left">{!! $farmer->city !!}</td>
                            <td class="text-center">{!! $farmer->state !!}</td>
                            <td class="text-center">{!! $farmer->zip !!}</td>
                            <td class="text-center">
                                <a href="{!! action('FarmersController@show', $farmer->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('FarmersController@edit', $farmer->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('FarmersController@destroy', $farmer->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $farmers->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('FarmersController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/farmer/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

