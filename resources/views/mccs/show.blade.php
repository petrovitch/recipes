@extends('master')
@section('name', 'Show Chess Club Member')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">User</th>
                    <th class="text-center report-headings">Name</th>
                    <th class="text-center report-headings">Zip</th>
                    <th class="text-center report-headings">USCF ID</th>
                    <th class="text-center report-headings">USDF Rating</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $mcc->username !!}</td>
                    <td class="text-left">{!! $mcc->name !!}</td>
                    <td class="text-left">{!! $mcc->zip !!}</td>
                    <td class="text-left">{!! $mcc->uscf_id !!}</td>
                    <td class="text-right">{!! $mcc->uscf_rating !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




