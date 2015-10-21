@extends('master')
@section('name', 'Show Farmer')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Farmer</th>
                    <th class="text-center report-headings">Street</th>
                    <th class="text-center report-headings">City</th>
                    <th class="text-center report-headings">State</th>
                    <th class="text-center report-headings">Zip</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $farmer->farmer !!}</td>
                    <td class="text-left">{!! $farmer->street !!}</td>
                    <td class="text-left">{!! $farmer->city !!}</td>
                    <td class="text-center">{!! $farmer->state !!}</td>
                    <td class="text-center">{!! $farmer->zip !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




