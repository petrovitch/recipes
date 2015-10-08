@extends('master')
@section('name', 'Edit Recipe')

@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Edit Recipe</legend>

                    <div class="form-group">
                        <label for="acct" class="col-lg-2 control-label">Category</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="acct" placeholder="Category" name="category"
                                   value="{{ $recipe->category }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                   value="{{ $recipe->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="author" class="col-lg-2 control-label">Author</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="author" placeholder="Author" name="author"
                                   value="{{ $recipe->author }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="recipe" class="col-lg-2 control-label">Recipe</label>
                        <div class="col-lg-10">
                            <textarea rows="4" class="form-control" id="recipe" placeholder="Recipe" name="recipe">{{ $recipe->recipe }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="instructions" class="col-lg-2 control-label">Instructions</label>
                        <div class="col-lg-10">
                            <textarea rows="4" class="form-control" id="instructions" placeholder="Instructions" name="instructions">{{ $recipe->instructions }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="microwave" class="col-lg-2 control-label">Microwave</label>
                        <div class="col-lg-10">
                            @if($recipe->microwave)
                            <input type="checkbox" class="form-control" id="microwave" name="author" checked>
                                @else
                                <input type="checkbox" class="form-control" id="microwave" name="author">
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection




