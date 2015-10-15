@extends('master')
@section('name', 'Edit Transaction')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Edit Transaction</legend>
                    <div class="form-group">
                        <label for="acct" class="col-lg-2 control-label">Acct</label>
                        <select class="selectpicker btn" id="acct" name="acct">
                            <option value={{$gltrn->acct}}>{{$gltrn->acct}} {{$gltrn->glcoa->title}}</option>
                            @foreach ($glcoas as $glcoa)
                                <option value={{$glcoa->acct}}>{{$glcoa->acct}} {{$glcoa->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-lg-2 control-label">Description</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="description" placeholder="Description"
                                   name="description"
                                   value="{{ $gltrn->description }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="crj" class="col-lg-2 control-label">CRJ</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="crj" placeholder="CRJ" name="crj"
                                   value="{{ $gltrn->crj }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date" class="col-lg-2 control-label">Date</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="date" placeholder="mm/dd/yyyy" name="date"
                                   value="{{ date('m/d/Y', strtotime($gltrn->date)) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="document" class="col-lg-2 control-label">Document</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="document" placeholder="Document" name="document"
                                   value="{{ $gltrn->document }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-lg-2 control-label">Amount</label>

                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount"
                                   value="{{ $gltrn->amount }}">
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




