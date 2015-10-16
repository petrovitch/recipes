@extends('master')
@section('name', 'Show Article')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">PGN</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left">{!! nl2br($article->pgn) !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




