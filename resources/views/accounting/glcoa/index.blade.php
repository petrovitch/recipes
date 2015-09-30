@extends('master')
@section('title', 'General Ledger Chart of Accounts')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($glcoas->isEmpty())
                <p> There are no accounts.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center" style="font-weight:bold">Acct</th>
                        <th class="text-center" style="font-weight:bold">Title</th>
                        <th class="text-center" style="font-weight:bold">Balance</th>
                        <th class="text-center" style="font-weight:bold">Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($glcoas as $glcoa)
                        <tr>
                            <td class="text-center">
                                <a href="{!! action('GlcoasController@edit', $glcoa->id) !!}">{!! $glcoa->acct !!} </a>
                            </td>
                            <td class="text-left">{!! $glcoa->title !!}</td>
                            <td class="text-right">${!! number_format($glcoa->init,2) !!}</td>
                            <td class="text-center">{!! $glcoa->created_at !!}</td>
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
        <div class="text-center">{!! $glcoas->render() !!}</div>
        <div class="text-left"><a href="/glcoa/create" class="btn btn-primary" role="button">New</a></div>
    </div>
@endsection

