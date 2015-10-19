@extends('master')
@section('title', 'Chess ECO')
@section('content')
    <form name="search" action="/ecos/search" method="post" class="form-horizontal">
        <span style="position: absolute;top: 65px;right: 5px;">
            <input type="text" name="token" placeholder="Filter...">
        </span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($ecos->isEmpty())
                <p> There are no ecos.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">@sortablelink ('ECO')</th>
                        <th class="text-center report-headings">@sortablelink ('Opening')</th>
                        <th class="text-center report-headings">@sortablelink ('Moves')</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ecos as $eco)
                        <tr>
                            <td class="text-center">{!! $eco->eco !!}</td>
                            <td class="text-left">{!! $eco->opening !!}</td>
                            <td class="text-left">{!! $eco->moves !!}</td>
                            <td class="text-center" style="width:75px">
                                <a href="{!! action('EcosController@show', $eco->id) !!}" title="Show" target="_blank"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('EcosController@edit', $eco->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('EcosController@destroy', $eco->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $ecos->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('EcosController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/eco/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

