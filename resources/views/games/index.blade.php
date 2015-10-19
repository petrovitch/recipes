@extends('master')
@section('title', 'Chess Games')
@section('content')
    <form name="search" action="/games/search" method="post" class="form-horizontal">
        <span style="position: absolute;top: 65px;right: 5px;">
            <input type="text" name="token" placeholder="Filter...">
        </span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($games->isEmpty())
                <p> There are no games.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">@sortablelink ('id')</th>
                        <th class="text-center report-headings">@sortablelink ('year')</th>
                        <th class="text-center report-headings">@sortablelink ('gamedate', 'Date')</th>
                        <th class="text-center report-headings">@sortablelink ('Event')</th>
                        <th class="text-center report-headings">@sortablelink ('title', 'Game')</th>
                        <th class="text-center report-headings">@sortablelink ('ECO')</th>
                        <th class="text-center report-headings">@sortablelink ('gameresult', 'Result')</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td class="text-center" style="width:75px">{!! $game->id !!}</td>
                            <td class="text-center" style="width:75px">{!! $game->year !!}</td>
                            <td class="text-center" style="width:100px">{!! $game->gameDate !!}</td>
                            <td class="text-left">{!! $game->event !!}</td>
                            <td class="text-left">{!! $game->title !!}</td>
                            <td class="text-center" style="width:100px">{!! $game->eco !!}</td>
                            <td class="text-center" style="width:100px">{!! $game->gameResult !!}</td>
                            <td class="text-center" style="width:75px">
                                <a href="{!! action('GamesController@show', $game->id) !!}" title="Show" target="_blank"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('GamesController@edit', $game->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('GamesController@destroy', $game->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $games->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('GamesController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <a href="{!! action('GamesController@html') !!}" title="Export PGN to HTML"><span class="glyphicons glyphicons-imac"></span> PGN </a> &nbsp;
            <span style="float:left">
                <a href="/game/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

