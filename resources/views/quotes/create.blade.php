@extends('master')
@section('name', 'Create Quotes')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Create Quotes</legend>

                    <div class="form-group">
                        <label for="quote" class="col-lg-2 control-label">Quote</label>
                        <div class="col-lg-10">
                            <textarea rows="8" class="form-control" id="quote" name="quote"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="author" class="col-lg-2 control-label">Author</label>
                        <div class="col-lg-10">
                            <input type="author" class="form-control" id="author"
                                   placeholder="Author" name="author">
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




