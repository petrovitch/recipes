@extends('master')
@section('name', 'Show Farm')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Farm</th>
                    <th class="text-center report-headings">Acres</th>
                    <th class="text-center report-headings">County ID</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $farm->farm !!}</td>
                    <td class="text-left">{!! $farm->acres !!}</td>
                    <td class="text-left">{!! $farm->county_id !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




