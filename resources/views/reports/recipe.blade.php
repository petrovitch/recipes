@extends('reports.master')
@section('name', 'Show Recipe')

@section('content')
    <h5>
        {{ $recipe->name }}
    </h5>
    <hr/>
    <p style="font-size:11px;font-weight:bold;">
        <i>{{ $recipe->category }}</i>
    </p>
    <div>
        <p style="font-size:11px;font-weight:bold;">
        <pre> {{ $recipe->recipe }} </pre>
        </p>
        <p style="font-size:11px;font-weight:bold;">
        <pre> {{ $recipe->instructions }} </pre>
        </p>
        <p> {{ $recipe->author }}</p>
    </div>
@endsection




