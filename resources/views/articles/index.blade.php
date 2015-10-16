@extends('master')
@section('title', 'Chess Articles')
@section('content')
    <form name="search" action="/articles/search" method="post" class="form-horizontal">
        <span style="position: absolute;top: 65px;right: 5px;">
            <input type="text" name="token" placeholder="Filter...">
        </span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($articles->isEmpty())
                <p> There are no articles.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Date</th>
                        <th class="text-center report-headings">Event</th>
                        <th class="text-center report-headings">Game</th>
                        <th class="text-center report-headings">ECO</th>
                        <th class="text-center report-headings">Result</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="text-center" style="width:100px">{!! date('m/d/Y', strtotime($article->gameDate)) !!}</td>
                            <td class="text-left">{!! $article->event !!}</td>
                            <td class="text-left">{!! $article->title !!}</td>
                            <td class="text-center" style="width:100px">{!! substr($article->eco,0,3) !!}</td>
                            <td class="text-center" style="width:100px">{!! $article->gameResult !!}</td>
                            <td class="text-center" style="width:75px">
                                <a href="{!! action('ArticlesController@show', $article->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('ArticlesController@edit', $article->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('ArticlesController@destroy', $article->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $articles->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('ArticlesController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/article/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

