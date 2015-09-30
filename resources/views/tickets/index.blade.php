@extends('master')
@section('title', 'View all tickets')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            @if ($tickets->isEmpty())
                <p>There is no ticket.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <td class="text-center report-headings">ID</td>
                        <td class="text-center report-headings">Title</td>
                        <td class="text-center report-headings">Status</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td class="text-right">{!! $ticket->id !!}</td>
                                <td class="text-left">
                                    <a href="{!! action('TicketsController@show', $ticket->slug) !!}">{!! $ticket->title !!}</a>
                                </td>
                                <td class="text-left">{!! $ticket->status ? 'Pending' : 'Answered' !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}</div>
            @endif
        </div>
    </div>
    <center>{!! $tickets->render() !!}</center>
@endsection