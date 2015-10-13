@extends('master')
@section('name', 'Edit State')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Edit State</legend>

                    <div class="form-group">
                        <label for="state_abr" class="col-lg-2 control-label">State Abbreviation</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="acct" placeholder="AR" name="state_abr"
                                   value="{{ $state->state_abr }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state" class="col-lg-2 control-label">State</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="state" placeholder="Arkansas" name="state"
                                   value="{{ $state->state }}">
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




