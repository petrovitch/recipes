@extends('master')
@section('title', 'General Ledger Chart of Accounts')
@section('content')

    <div class="container col-md-12 col-md-offset">
        <div class="panel panel-default">
            @if ($zipcodes->isEmpty())
                <p> There are no zip-codes.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">City</th>
                        <th class="text-center report-headings">Abr</th>
                        <th class="text-center report-headings">State</th>
                        <th class="text-center report-headings">Zipcode</th>
                        <th class="text-center report-headings">County</th>
                        <th class="text-center report-headings">Country</th>
                        <th class="text-center report-headings">Lon</th>
                        <th class="text-center report-headings">Lat</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($zipcodes as $zipcode)
                        <tr>
                            <td class="text-left">{!! $zipcode->city !!}</td>
                            <td class="text-center">{!! strtoupper($zipcode->state) !!}</td>
                            <td class="text-left">{!! $zipcode->state_name !!}</td>
                            <td class="text-right">{!! $zipcode->zipcode !!}</td>
                            <td class="text-left">{!! $zipcode->county !!}</td>
                            <td class="text-left">{!! $zipcode->country !!}</td>
                            <td class="text-right">{!! $zipcode->lon !!}</td>
                            <td class="text-right">{!! $zipcode->lat !!}</td>
                            <td class="text-center">
                                <a href="{!! action('ZipcodesController@show', $zipcode->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('ZipcodesController@edit', $zipcode->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('ZipcodesController@destroy', $zipcode->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $zipcodes->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('ZipcodesController@excel', $zipcode->id) !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/zipcode/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

