@extends('master')
@section('name', 'Show Commodity')

@section('content')
    <div class="container col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Commodity</th>
                    <th class="text-center report-headings">Abbreviation</th>
                    <th class="text-center report-headings">Test Weight</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $commodity->commodity !!}</td>
                    <td class="text-center">{!! $commodity->abbr !!}</td>
                    <td class="text-right">{!! $commodity->test_weight !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




