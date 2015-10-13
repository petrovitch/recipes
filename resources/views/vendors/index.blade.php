@extends('master')
@section('title', 'Vendors')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($vendors->isEmpty())
                <p> There are no vendors.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Vendor</th>
                        <th class="text-center report-headings">Street</th>
                        <th class="text-center report-headings">City</th>
                        <th class="text-center report-headings">State</th>
                        <th class="text-center report-headings">Zip</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $vendor)
                        <tr>
                            <td class="text-left">{!! $vendor->vendor !!}</td>
                            <td class="text-left">{!! $vendor->street !!}</td>
                            <td class="text-left">{!! $vendor->city !!}</td>
                            <td class="text-center">{!! $vendor->state !!}</td>
                            <td class="text-center">{!! $vendor->zip !!}</td>
                            <td class="text-center">
                                <a href="{!! action('VendorsController@show', $vendor->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('VendorsController@edit', $vendor->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('VendorsController@destroy', $vendor->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $vendors->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('VendorsController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/vendor/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

