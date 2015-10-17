@extends('master')
@section('title', 'Search')
@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <form name="search" method="post" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <fieldset>
                    <legend>Search</legend>

                    <div class="form-group">
                        <label for="player" class="col-lg-2 control-label">Player</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="player"
                                   placeholder="Player" name="player">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="color" class="col-lg-2 control-label">Color</label>

                        <div class="col-lg-10">
                            <input type="radio" name="color" value="white"> White &nbsp;
                            <input type="radio" name="color" value="black"> Black &nbsp;
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection

