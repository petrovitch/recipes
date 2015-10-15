@extends('reports.master')
@section('name', 'Show Recipes')

@section('content')
    @foreach($recipes as $vm)
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <tr style="background-color:#dfdfdf">
                    <td><h4>{{ $vm->name }}</h4></td>
                </tr>
                <tr style="background-color:#efefef">
                    <td>{!! nl2br($vm->recipe) !!}</td>
                </tr>
                @if($vm->author)
                    <tr style="background-color:#efefef">
                        <td><br><br><i>{{ $vm->author }}</i></td>
                    </tr>
                @endif
            </table>
        </div>
    @endforeach
@endsection




