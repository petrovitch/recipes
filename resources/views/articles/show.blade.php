@extends('master')
@section('name', 'Show Article')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Name</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! $articlre->name !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




