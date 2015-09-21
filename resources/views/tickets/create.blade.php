@extends('master')
@section('title', 'Contact')
@section('content')
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <form class="form-horizontal" method="post">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <fieldset>
                    <legend>Submit a new ticket</legend>

                    <label for="title" class="control-label col-lg-offset-1">Title</label>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-1">
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                        </div>
                    </div>

                    <label for="content" class="control-label col-lg-offset-1">Content</label>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-1">
                            <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                            <span class="help-block">Feel free to ask us any question.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-1">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary pull-left">Submit</button>
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