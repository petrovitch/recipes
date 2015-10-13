@extends('master')
@section('title', 'General Ledger Chart of Accounts')
@section('content')

    <div class="container col-md-12 col-md-offset">
        <div class="panel panel-default">
            @if ($glcoas->isEmpty())
                <p> There are no accounts.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Acct</th>
                        <th class="text-center report-headings">Title</th>
                        <th class="text-center report-headings">Opening</th>
                        <th class="text-center report-headings">Change</th>
                        <th class="text-center report-headings">Balance</th>
                        <th class="text-center report-headings" title="Number of transactions">Count</th>
                        <th class="text-center report-headings">Created</th>
                        <th class="text-center report-headings">Modified</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($glcoas as $glcoa)
                        <?php
                            $results = DB::select( DB::raw("SELECT SUM(amount) AS total, COUNT(amount) AS count FROM gltrns WHERE acct = " . $glcoa->acct) );
                            $count = $results[0]->count;
                            $change = $results[0]->total;
                            $balance = $glcoa->init + $change;
                        ?>
                        <tr>
                            <td class="text-center">
                                <a href="{!! action('GlcoasController@edit', $glcoa->id) !!}">{!! $glcoa->acct !!} </a>
                            </td>
                            <td class="text-left">{!! $glcoa->title !!}</td>
                            <td class="text-right">{!! number_format($glcoa->init,2) !!}</td>
                            <td class="text-right">{!! number_format($change,2) !!}</td>
                            <td class="text-right">{!! number_format($balance,2) !!}</td>
                            <td class="text-right">{!! number_format($count,0) !!}</td>
                            <td class="text-center">{!! $glcoa->created_at !!}</td>
                            <td class="text-center">{!! $glcoa->updated_at !!}</td>
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
                {{--@if (session('status'))--}}
                    {{--<div class="alert alert-success">--}}
                        {{--{{ session('status') }}--}}
                    {{--</div>--}}
                {{--@endif--}}
        </div>

        <div class="text-center">{!! $glcoas->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('GlcoasController@glcoaExcel', $glcoa->id) !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <a href="{!! action('GlcoasController@glcoaPdf', $glcoa->id) !!}" title="Export to PDF"><span class="glyphicon glyphicon-th"></span> PDF </a> &nbsp;
            <span style="float:left">
                <a href="/glcoa/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

