@extends('master')
@section('title', 'Recipes')
@section('content')
    <form name="search" action="/recipes/search" method="post" class="form-horizontal">
        <span style="position: absolute;top: 65px;right: 5px;">
            <input type="text" name="token" placeholder="Filter...">
        </span>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

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
                        <th class="text-center report-headings">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recipes as $recipe)
                        <tr>
                            <td class="text-left" style="width:50px">{!! $recipe->category !!}</td>
                            <td class="text-left" style="width:200px">{!! $recipe->name !!}</td>
                            <td class="text-left" style="width:80px">{!! $recipe->author !!}</td>
                            {{--<td class="text-left">{!! substr($recipe->recipe, 0, 100) !!}</td>--}}
                            <td class="text-center" style="width:50px">
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
            <a href="{!! action('RecipesController@recipesPdf', ['offset' => 0, 'limit' => 3]) !!}" title="Export to PDF"><span class="glyphicon glyphicon-th"></span> PDF </a> &nbsp;
            <a href="{!! action('RecipesController@recipesHtml', ['offset' => 0, 'limit' => 500]) !!}" title="Export to HTML"><span class="glyphicon glyphicon-list-alt"></span> HTML </a> &nbsp;
            <a href="{!! action('RecipesController@menu', ['offset' => 0, 'limit' => 500]) !!}" title="Export to HTML"><span class="glyphicons glyphicons-notes-2"></span> Menu </a> &nbsp;
            <span style="float:left">
                <a href="/recipe/create" class="btn btn-sm btn-primary btn-raised" role="button">Add</a> &nbsp;
            </span>
        </div>
    </div>
@endsection

