@extends('master')
@section('name', 'Show Zipcodes')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Zipcode</th>
                    <th class="text-center report-headings">City</th>
                    <th class="text-center report-headings">State</th>
                    <th class="text-center report-headings">State Name</th>
                    <th class="text-center report-headings">County</th>
                    <th class="text-center report-headings">Country</th>
                    <th class="text-center report-headings">Latitude</th>
                    <th class="text-center report-headings">Longitude</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $zipcode->zipcode !!}</td>
                    <td class="text-left">{!! $zipcode->city !!}</td>
                    <td class="text-left">{!! $zipcode->state !!}</td>
                    <td class="text-left">{!! $zipcode->state_name !!}</td>
                    <td class="text-left">{!! $zipcode->county !!}</td>
                    <td class="text-left">{!! $zipcode->country !!}</td>
                    <td class="text-left">{!! $zipcode->lat !!}</td>
                    <td class="text-left">{!! $zipcode->lon !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




