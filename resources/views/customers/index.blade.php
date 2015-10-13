@extends('master')
@section('title', 'Customers')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($customers->isEmpty())
                <p> There are no customers.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Customer</th>
                        <th class="text-center report-headings">Street</th>
                        <th class="text-center report-headings">City</th>
                        <th class="text-center report-headings">State</th>
                        <th class="text-center report-headings">Zip</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td class="text-left">{!! $customer->customer !!}</td>
                            <td class="text-left">{!! $customer->street !!}</td>
                            <td class="text-left">{!! $customer->city !!}</td>
                            <td class="text-center">{!! $customer->state !!}</td>
                            <td class="text-center">{!! $customer->zip !!}</td>
                            <td class="text-center">
                                <a href="{!! action('CustomersController@show', $customer->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('CustomersController@edit', $customer->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('CustomersController@destroy', $customer->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
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

        <div class="text-center">{!! $customers->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('CustomersController@excel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <span style="float:left">
                <a href="/customer/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

