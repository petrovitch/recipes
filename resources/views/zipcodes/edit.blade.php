@extends('master')
@section('name', 'Edit Zipcode')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Edit Zipcode</legend>

                    <div class="form-group">
                        <label for="city" class="col-lg-2 control-label">City</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="city" placeholder="City" name="city"
                                   value="{{ $zipcode->city }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state" class="col-lg-2 control-label">State</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="state" placeholder="AR" name="state"
                                   value="{{ $zipcode->state }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="state_name" class="col-lg-2 control-label">State</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="state_name" placeholder="Arkansas"
                                   name="state_name"
                                   value="{{ $zipcode->state_name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zipcode" class="col-lg-2 control-label">Zipcode</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="zipcode" placeholder="72396" name="zipcode"
                                   value="{{ $zipcode->zipcode }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="county" class="col-lg-2 control-label">County</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="county" placeholder="Cross" name="county"
                                   value="{{ $zipcode->county }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="country" class="col-lg-2 control-label">Country</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="country" placeholder="United States"
                                   name="country"
                                   value="{{ $zipcode->country }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lat" class="col-lg-2 control-label">Latitude</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="lat" placeholder="41.8208" name="lat"
                                   value="{{ $zipcode->lat }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lon" class="col-lg-2 control-label">Longitude</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="lon" placeholder="-71.41306" name="lon"
                                   value="{{ $zipcode->lon }}">
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




