@extends('master')
@section('name', 'Create Articles')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Create Articles</legend>

                    <div class="form-group">
                        <label for="pgn" class="col-lg-2 control-label">PGN</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="pgn"
                                   placeholder="PGN" name="pgn">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fritz" class="col-lg-2 control-label">Analysis</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="fritz"
                                   placeholder="Analysis" name="fritz">
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




