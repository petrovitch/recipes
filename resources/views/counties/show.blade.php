@extends('master')
@section('name', 'Show County')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">County</th>
                    <th class="text-center report-headings">Label</th>
                    <th class="text-center report-headings">Locale</th>
                    <th class="text-center report-headings">State ID</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $county->county !!}</td>
                    <td class="text-left">{!! $county->label !!}</td>
                    <td class="text-left">{!! $county->locale !!}</td>
                    <td class="text-left">{!! $county->state_id !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




