@extends('master')
@section('name', 'Edit ECO')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Edit ECO</legend>

                    <div class="form-group">
                        <label for="eco" class="col-lg-2 control-label">ECO</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="eco"
                                   placeholder="ECO" name="eco"
                                   value="{{ $eco->eco }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="opening" class="col-lg-2 control-label">Opening</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="opening"
                                   placeholder="Opening" name="opening"
                                   value="{{ $eco->opening }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="moves" class="col-lg-2 control-label">Moves</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="moves"
                                   placeholder="Moves" name="moves"
                                   value="{{ $eco->moves }}">
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




