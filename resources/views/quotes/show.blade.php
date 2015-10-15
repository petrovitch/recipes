@extends('master')
@section('name', 'Quotes')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Quote</th>
                    <th class="text-center report-headings">Author</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $quote->quote !!}</td>
                    <td class="text-left">{!! $quote->author !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




