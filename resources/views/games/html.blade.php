@extends('master')
@section('name', 'PGN')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">
            @foreach ($games as $game)
            {!! nl2br($game->pgn) !!} <br/>
            @endforeach
        </div>
    </div>
    <div class="text-center">{!! $games->render() !!}</div>
@endsection




