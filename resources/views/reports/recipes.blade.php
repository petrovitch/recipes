@extends('reports.master')
@section('name', 'Show Recipes')

@section('content')
    @foreach($recipes as $vm)
        <div class="container col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div><h4>{{ $vm->name }}</h4></div>
                <div ng-if="$vm.author"><i>{{ $vm->author }}</i></div>
                <div><pre>{!! $vm->recipe !!}</pre></div>
                <div><pre>{!! $vm->instructions !!}</pre></div>
            </div>
        </div>
    @endforeach
@endsection




