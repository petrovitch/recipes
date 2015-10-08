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
                        <p style="font-size:11px;font-weight:bold;"><pre>{{ $recipe->recipe }}</pre></p>
                        <p style="font-size:11px;font-weight:bold;">
                        <pre>{{ $recipe->instructions }}</pre>
                        </p>
                        @if($recipe->microwave)
                        <p>Microwave</p>
                        @endif
                        <p style="color:#333333">{{ $recipe->author }}</p>
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
