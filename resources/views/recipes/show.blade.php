@extends('master')
@section('name', 'Show Recipe')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="alert alert-primary" role="alert">
                <div style="position:relative;">
                    <h5><span class="glyphicon glyphicon-user"></span>
                        {{ $recipe->name }}
                    </h5>
                    <hr/>
                    <p style="font-size:11px;font-weight:bold;">
                        <i>{{ $recipe->category }}</i>
                    </p>
                </div>
                <div>
                    <div class="alert">
                        <p style="color:black;font-size:11px;font-weight:bold;">
                            {!! nl2br($recipe->recipe) !!}
                        </p>
                        @if($recipe->instructions)
                        <p style="color:black;font-size:11px;font-weight:bold;">
                            <br>{!! wordwrap($recipe->instructions) !!}
                        </p>
                        @endif
                        @if($recipe->microwave)
                        <p>Microwave</p>
                        @endif
                        @if($recipe->author)
                        <p style="color:#333333">
                            <br>{!! $recipe->author !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        <a href="{!! action('RecipesController@recipePdf', $recipe->id) !!}" title="Export to PDF"><span
                    class="glyphicon glyphicon-th"></span> PDF </a> &nbsp;
    </div>
    <!--<pre>  | json</pre>-->
@endsection
