@extends('master')
@section('title', 'Word Frequency in Recipes')
@section('content')
    {!! csrf_field() !!}
    <div class="container col-md-2 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th class="text-center report-headings">Word</th>
                    <th class="text-center report-headings">Frequency</th>
                </tr>
                </thead>
                <tbody>
                @foreach($words as $word => $frequency)
                    <tr>
                        <td class="text-left">{!! $word !!}</td>
                        <td class="text-right">{!! $frequency !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

