@extends('master')
@section('title', 'General Ledger')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($gltrns->isEmpty())
                <p> There are no transaction.</p>
            @else
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Acct</th>
                        <th class="text-center report-headings">Description</th>
                        <th class="text-center report-headings">Date</th>
                        <th class="text-center report-headings">Document</th>
                        <th class="text-center report-headings">Amount</th>
                        <th class="text-center report-headings">Created at</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gltrns as $gltrn)
                        <tr>
                            <td class="text-center">
                                <a href="{!! action('GltrnsController@edit', $gltrn->id) !!}">{!! $gltrn->acct !!} </a>
                            </td>
                            <td class="text-left">{!! $gltrn->description !!}</td>
                            <td class="text-left">{!! $gltrn->date !!}</td>
                            <td class="text-left">{!! $gltrn->document !!}</td>
                            <td class="text-right">{!! number_format($gltrn->amount,2) !!}</td>
                            <td class="text-center">{!! $gltrn->created_at !!}</td>
                            <td class="text-center">
                                <a href="{!! action('GltrnsController@show', $gltrn->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('GltrnsController@edit', $gltrn->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('GltrnsController@destroy', $gltrn->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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
        <div class="text-center">{!! $gltrns->render() !!}</div>
        <div class="text-left">
            <a href="/gltrn/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
        </div>
    </div>

@endsection

