@extends('master')
@section('title', 'General Ledger')
@section('content')

    <div class="container col-md-12 col-md">
        <div class="panel panel-default">
            @if ($gltrns->isEmpty())
                <p> There are no transaction.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Acct</th>
                        <th class="text-center report-headings">Title</th>
                        <th class="text-center report-headings">Description</th>
                        <th class="text-center report-headings">CRJ</th>
                        <th class="text-center report-headings">Date</th>
                        <th class="text-center report-headings">Document</th>
                        <th class="text-center report-headings">Debit</th>
                        <th class="text-center report-headings">Credit</th>
                        <th class="text-center report-headings">Created at</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gltrns as $gltrn)
                        <?php
                            if($gltrn->amount >= 0){
                                $debit = $gltrn->amount;
                                $credit = 0;
                            } else {
                                $debit = 0;
                                $credit = abs($gltrn->amount);
                            }
                        ?>
                        <tr>
                            <td class="text-center">
                                <a href="{!! action('GltrnsController@edit', $gltrn->id) !!}" title="Edit">{!! $gltrn->acct !!} </a>
                            </td>
                            <td class="text-left">{!! $gltrn->glcoa->title !!}</td>
                            <td class="text-left">{!! $gltrn->description !!}</td>
                            <td class="text-center">{!! $gltrn->crj !!}</td>
                            <td class="text-center">{!! $gltrn->date !!}</td>
                            <td class="text-left">{!! $gltrn->document !!}</td>
                            <td class="text-right">{!! number_format($debit,2) !!}</td>
                            <td class="text-right">{!! number_format($credit,2) !!}</td>
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

                {{--@if (session('status'))--}}
                    {{--<div class="alert alert-success">--}}
                        {{--{{ session('status') }}--}}
                    {{--</div>--}}
                {{--@endif--}}

        </div>
        <div class="text-center">{!! $gltrns->render() !!}</div>
        <div class="text-left">
            <a href="/gltrn/create" class="btn btn-md btn-primary btn-raised" role="button">Add</a> &nbsp;
        </div>
    </div>
@endsection

