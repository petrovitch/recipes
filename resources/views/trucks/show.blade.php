@extends('master')
@section('name', 'Show Trucking Company')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Company</th>
                    <th class="text-center report-headings">Street</th>
                    <th class="text-center report-headings">City</th>
                    <th class="text-center report-headings">State</th>
                    <th class="text-center report-headings">Zip</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $truck->company !!}</td>
                    <td class="text-left">{!! $truck->street !!}</td>
                    <td class="text-left">{!! $truck->city !!}</td>
                    <td class="text-center">{!! $truck->state !!}</td>
                    <td class="text-center">{!! $truck->zip !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




