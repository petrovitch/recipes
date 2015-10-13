@extends('master')
@section('name', 'Show State')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Abr</th>
                    <th class="text-center report-headings">State</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! strtoupper($state->state_abr) !!}</td>
                    <td class="text-left">{!! $state->state !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




