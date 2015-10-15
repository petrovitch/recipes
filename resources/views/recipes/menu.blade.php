@extends('master')
@section('title', 'Recipes')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            @if ($recipes->isEmpty())
                <p> There are no recipes.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        {{--<th class="text-center report-headings">@sortablelink ('category')</th>--}}
                        <th class="text-center report-headings">Category</th>
                        <th class="text-center report-headings">Name</th>
                        <th class="text-center report-headings">Author</th>
                        {{--<th class="text-center report-headings">Recipe</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recipes as $recipe)
                        <tr>
                            <td class="text-left" style="width:50px">{!! $recipe->category !!}</td>
                            <td class="text-left" style="width:200px">{!! $recipe->name !!}</td>
                            <td class="text-left" style="width:80px">{!! $recipe->author !!}</td>
                            {{--<td class="text-left">{!! substr($recipe->recipe, 0, 100) !!}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

