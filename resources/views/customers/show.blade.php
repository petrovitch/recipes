@extends('master')
@section('name', 'Show Customer')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Customer</th>
                    <th class="text-center report-headings">Street</th>
                    <th class="text-center report-headings">City</th>
                    <th class="text-center report-headings">State</th>
                    <th class="text-center report-headings">Zip</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $customer->customer !!}</td>
                    <td class="text-left">{!! $customer->street !!}</td>
                    <td class="text-left">{!! $customer->city !!}</td>
                    <td class="text-center">{!! $customer->state !!}</td>
                    <td class="text-center">{!! $customer->zip !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




