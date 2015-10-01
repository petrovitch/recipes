@extends('master')
@section('title', 'General Ledger Chart of Accounts')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($glcoas->isEmpty())
                <p> There are no accounts.</p>
            @else
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Acct</th>
                        <th class="text-center report-headings">Title</th>
                        <th class="text-center report-headings">Opening</th>
                        <th class="text-center report-headings">Created at</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($glcoas as $glcoa)
                        <tr>
                            <td class="text-center">
                                <a href="{!! action('GlcoasController@edit', $glcoa->id) !!}">{!! $glcoa->acct !!} </a>
                            </td>
                            <td class="text-left">{!! $glcoa->title !!}</td>
                            <td class="text-right">{!! number_format($glcoa->init,2) !!}</td>
                            <td class="text-center">{!! $glcoa->created_at !!}</td>
                            <td class="text-center">
                                <a href="{!! action('GlcoasController@show', $glcoa->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('GlcoasController@edit', $glcoa->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('GlcoasController@destroy', $glcoa->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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
        <div class="text-center">{!! $glcoas->render() !!}</div>
        <div class="text-left">
            <a href="/glcoa/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            <a href="/glcoa/init" class="btn btn-sm btn-active btn-raised" role="button">Check</a>
        </div>
    </div>

@endsection

