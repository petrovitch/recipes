@extends('master')
@section('name', 'Edit Farm')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Edit Farm</legend>

                    <div class="form-group">
                        <label for="farm" class="col-lg-2 control-label">Farm</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="farm"
                                   placeholder="Farm" name="farm"
                                   value="{{ $farm->farm }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="farm" class="col-lg-2 control-label">Acres</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="acres"
                                   placeholder="Acres" name="acres"
                                   value="{{ $farm->street }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="farm" class="col-lg-2 control-label">County ID</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="county_id"
                                   placeholder="County ID" name="county_id"
                                   value="{{ $farm->county_id }}">
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




