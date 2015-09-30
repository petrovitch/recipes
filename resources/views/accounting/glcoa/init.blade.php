@extends('master')
@section('title', 'General Ledger Chart of Accounts')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($results[0]->balance != 0)
                <div class="alert alert-warning">
                    Your opening chart of accounts totals are out-of-balance: ${{ $results[0]->balance }}
                </div>
            @else
                <div class="alert alert-success">
                    Your opening chart of accounts totals are in balance.
                </div>
            @endif
        </div>
    </div>
@endsection

