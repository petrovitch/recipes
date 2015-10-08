@extends('master')
@section('title', 'Recipes')
@section('content')

    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            @if ($recipes->isEmpty())
                <p> There are no recipes.</p>
            @else
                <table class="table table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center report-headings">Category</th>
                        <th class="text-center report-headings">Name</th>
                        <th class="text-center report-headings">Author</th>
                        {{--<th class="text-center report-headings">Recipe</th>--}}
                        <th class="text-center report-headings">Instructions</th>
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recipes as $recipe)
                        <tr>
                            <td class="text-left" style="width:100px">{!! $recipe->category !!}</td>
                            <td class="text-left" style="width:200px">{!! $recipe->name !!}</td>
                            <td class="text-left" style="width:200px">{!! $recipe->author !!}</td>
                            {{--<td class="text-left">{!! substr($recipe->recipe, 0, 100) !!}</td>--}}
                            <td class="text-left">{!! substr($recipe->instructions, 0, 100) !!}</td>
                            <td class="text-center" style="width:90px">
                                <a href="{!! action('RecipesController@show', $recipe->id) !!}" title="Show"><span class="glyphicon glyphicon-list"></span></a>
                                <a href="{!! action('RecipesController@edit', $recipe->id) !!}" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="{!! action('RecipesController@destroy', $recipe->id) !!}" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="text-center">{!! $recipes->render() !!}</div>

        <div class="text-right">
            <a href="{!! action('RecipesController@recipesExcel') !!}" title="Export to Excel"><span class="glyphicon glyphicon-download-alt"></span> Excel </a> &nbsp;
            <a href="{!! action('RecipesController@recipesPdf') !!}" title="Export to PDF"><span class="glyphicon glyphicon-th"></span> PDF </a> &nbsp;
            <span style="float:left">
                <a href="/recipe/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>

    </div>
@endsection

