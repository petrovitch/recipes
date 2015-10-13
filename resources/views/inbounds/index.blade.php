@extends('master')
@section('title', 'Inbound Tickets')
@section('content')

    <div class="container col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            @if ($inbounds->isEmpty())
                <p> There are no inbound tickets.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Ticket</th>
                        <th class="text-center report-headings">Date</th>
                        <th class="text-center report-headings">Time</th>
                        <th class="text-center report-headings">Producer</th>
                        <th class="text-center report-headings">Commodity</th>
                        <th class="text-center report-headings">Gross</th>
                        <th class="text-center report-headings">Tare</th>
                        <th class="text-center report-headings">Net</th>
                        <th class="text-center report-headings">On</th>
                        <th class="text-center report-headings">Bushels</th>
                        <th class="text-center report-headings">Truck ID</th>
                        <th class="text-center report-headings">Grade</th>
                        <th class="text-center report-headings">Moist</th>
                        <th class="text-center report-headings">Test Wt</th>
                        <th class="text-center report-headings">Damage</th>
                        <th class="text-center report-headings">Heat Dam</th>
                        <th class="text-center report-headings">FM</th>
                        <th class="text-center report-headings">Splits</th>
                        <th class="text-center report-headings">Other</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inbounds as $inbound)
                        <tr>
                            <td class="text-left">{!! $inbound->ticket !!}</td>
                            <td class="text-center">{!! $inbound->delivery_date !!}</td>
                            <td class="text-center">{!! $inbound->delivery_time !!}</td>
                            <td class="text-left">{!! $inbound->producer !!}</td>
                            <td class="text-left">{!! $inbound->commodity !!}</td>
                            <td class="text-right">{!! $inbound->gross !!}</td>
                            <td class="text-right">{!! $inbound->tare !!}</td>
                            <td class="text-right">{!! $inbound->net !!}</td>
                            <td class="text-left">{!! $inbound->driver_on !!}</td>
                            <td class="text-right">{!! $inbound->bushels !!}</td>
                            <td class="text-left">{!! $inbound->truck_id !!}</td>
                            <td class="text-left">{!! $inbound->grade !!}</td>
                            <td class="text-right">{!! $inbound->moisture !!}</td>
                            <td class="text-right">{!! $inbound->test_weight !!}</td>
                            <td class="text-right">{!! $inbound->damage !!}</td>
                            <td class="text-right">{!! $inbound->head_damage !!}</td>
                            <td class="text-right">{!! $inbound->fm !!}</td>
                            <td class="text-right">{!! $inbound->splits !!}</td>
                            <td class="text-right">{!! $inbound->other !!}</td>
                            <td class="text-center">
                                <a href="{!! action('InboundsController@show', $inbound->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('InboundsController@edit', $inbound->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('InboundsController@destroy', $inbound->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
        </div>

        <div class="text-center">{!! $inbounds->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('InboundsController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/inbound/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

