@extends('master')
@section('name', 'Show ECO')

@section('content')
    <script type="text/javascript" src="http://chesstempo.com/js/pgnyui.js"></script>
    <script type="text/javascript" src="http://chesstempo.com/js/pgnviewer.js"></script>
    <link type="text/css" rel="stylesheet" href="http://chesstempo.com/css/board-min.css"></link>

    <div class="container col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <strong>{{ $eco->ECO }}</strong>
            <div id="demo-container"></div>
            <div id="demo-moves"></div>
        </div>
        <a href="http://chesstempo.com/" target="_blank"><span style="font-size:10px">Chess Viewer by Chess Tempo</span></a>
    </div>

    <script>
        new PgnViewer(
                {
                    boardName: "demo",
                    pgnFile: '../../json/game.pgn',
                    pieceSet: 'leipzig',
                    pieceSize: 46
                }
        );
    </script>
@endsection




