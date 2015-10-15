@extends('master')
@section('name', 'Create Chess Club Members')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Create Chess Club Members</legend>

                    <div class="form-group">
                        <label for="username" class="col-lg-2 control-label">User</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="username"
                                   placeholder="User" name="username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password"
                                   placeholder="Password" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="name"
                                   placeholder="Name" name="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zip" class="col-lg-2 control-label">Zip</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="zip"
                                   placeholder="Zip" name="zip">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="uscf_id" class="col-lg-2 control-label">USCF ID</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="uscf_id"
                                   placeholder="USCF ID" name="uscf_id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="uscf_rating" class="col-lg-2 control-label">USCF Rating</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="uscf_rating"
                                   placeholder="USCF Rating" name="uscf_rating">
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




