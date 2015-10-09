@extends('reports.master')
@section('name', 'Show Recipe')

@section('content')
    <div class="col-md-6 col-md-offset-1">
        <table class="table table-bordered">
            <tr style="background-color:#dfdfdf">
                <td><h4>{{ $vm->name }}</h4></td>
            </tr>
            <tr style="background-color:#efefef">
                <td>{!! nl2br($vm->recipe) !!}</td>
            </tr>
            @if($vm->instructions)
                <tr style="background-color:#efefef">
                    <td><br><br>{!! wordwrap($vm->instructions) !!}</td>
                </tr>
            @endif
            @if($vm->author)
                <tr style="background-color:#efefef">
                    <td><br><br><i>{{ $vm->author }}</i></td>
                </tr>
            @endif
        </table>
    </div>
@endsection




