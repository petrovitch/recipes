@extends('master')
@section('name', 'Show ECO')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">ECO</th>
                    <th class="text-center report-headings">Opening</th>
                    <th class="text-center report-headings">Moves</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $eco->eco !!}</td>
                    <td class="text-left">{!! $eco->opening !!}</td>
                    <td class="text-left">{!! $eco->moves !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




