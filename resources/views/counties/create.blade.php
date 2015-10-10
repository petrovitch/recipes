@extends('master')
@section('name', 'Create County')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Create County</legend>

                    <div class="form-group">
                        <label for="county" class="col-lg-2 control-label">County</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="county" placeholder="Autauga" name="county">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="label" class="col-lg-2 control-label">Label</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="label" placeholder="Autauga ( AL )" name="Label">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="locale" class="col-lg-2 control-label">Locale</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="locale" placeholder="AL | Autauga" name="locale">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state_id" class="col-lg-2 control-label">State ID</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="state_id" placeholder="1" name="state_id">
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




