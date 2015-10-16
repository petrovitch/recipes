@extends('master')
@section('title', 'Quotes')
@section('content')
    <form name="search" action="/quotes/search" method="post" class="form-horizontal">
        <span style="position: absolute;top: 65px;right: 5px;">
            <input type="text" name="token" placeholder="Filter...">
        </span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($quotes->isEmpty())
                <p> There are no quotes.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Quote</th>
                        <th class="text-center report-headings">Author</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotes as $quote)
                        <tr>
                            <td class="text-left">{!! $quote->quote !!}</td>
                            <td class="text-left" style="width:150px">{!! $quote->author !!}</td>
                            <td class="text-center" style="width:75px"nowrap>
                                <a href="{!! action('QuotesController@show', $quote->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('QuotesController@edit', $quote->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('QuotesController@destroy', $quote->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $quotes->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('QuotesController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/quote/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

