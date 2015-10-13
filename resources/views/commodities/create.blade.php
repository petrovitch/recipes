@extends('master')
@section('name', 'Create Commodity')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Create Commodity</legend>

                    <div class="form-group">
                        <label for="commodity" class="col-lg-2 control-label">Commodity</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control"
                                   id="commodity" placeholder="Commodity" name="commodity">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="abbr" class="col-lg-2 control-label">Abbreviation</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control"
                                   id="abbr" placeholder="Abbreviation" name="abbr">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="test_weight" class="col-lg-2 control-label">Test Weight</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control"
                                   id="test_weight" placeholder="Test Weight" name="test_weight">
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




