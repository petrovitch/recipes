@extends('master')
@section('name', 'Show Account')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Show Account</legend>

                    <div class="form-group">
                        <label for="acct" class="col-lg-2 control-label">Acct</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="acct" placeholder="Account Numbrer" name="acct"
                                   value="{{ $glcoa->acct }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                                   value="{{ $glcoa->title }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="init" class="col-lg-2 control-label">Balance</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="init" placeholder="Opening Balance" name="init"
                                   value="{{ $glcoa->init }}" disabled>
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




