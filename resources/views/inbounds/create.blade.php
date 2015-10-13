@extends('master')
@section('name', 'Create Inbound Tickets')

@section('content')
    <div class="container col-md-6 col-md-offset-3">
        <div class="well well bs-component">

            <form class="form-horizontal" method="post">
                {!! csrf_field() !!}
                <fieldset>
                    <legend>Create Inbound Tickets</legend>

                    <div class="form-group">
                        <label for="ticket" class="col-lg-2 control-label">Ticket</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="ticket"
                                   placeholder="Inbound Ticket" name="ticket">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="delivery_date" class="col-lg-2 control-label">Date</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="delivery_date"
                                   placeholder="Delivery Date" name="delivery_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="delivery_time" class="col-lg-2 control-label">Time</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="delivery_time"
                                   placeholder="Delivery Time" name="delivery_time">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="producer" class="col-lg-2 control-label">Producer</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="producer"
                                   placeholder="Producer " name="producer">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="commodity" class="col-lg-2 control-label">Commodity</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="commodity"
                                   placeholder="Commodity" name="commodity">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gross" class="col-lg-2 control-label">Gross</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="gross"
                                   placeholder="Gross Weight" name="gross">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tare" class="col-lg-2 control-label">Tare</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="tare"
                                   placeholder="Tare Weight" name="tare">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="net" class="col-lg-2 control-label">Net</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="net"
                                   placeholder="Net Weight" name="net">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="driver_on" class="col-lg-2 control-label">Driver On/Off</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="driver_on"
                                   placeholder="Driver On/Off" name="driver_on">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="truck_id" class="col-lg-2 control-label">Truck ID</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="truck_id"
                                   placeholder="Truck ID" name="v">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="grade" class="col-lg-2 control-label">Grade</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="grade"
                                   placeholder="Grade" name="grade">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="moisture" class="col-lg-2 control-label">Moisture</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="moisture"
                                   placeholder="Moisture" name="moisture">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="test_weight" class="col-lg-2 control-label">Test Weight</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="test_weight"
                                   placeholder="Test Weight" name="test_weight">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="damage" class="col-lg-2 control-label">Damage</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="damage"
                                   placeholder="Damage" name="damage">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="heat_damage" class="col-lg-2 control-label">Heat Damage</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="heat_damage"
                                   placeholder="Heat Damage" name="heat_damage">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fm" class="col-lg-2 control-label">FM</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="fm"
                                   placeholder="Foreign Matter" name="fm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="splits" class="col-lg-2 control-label">Splits</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="splits"
                                   placeholder="Splits" name="splits">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="other" class="col-lg-2 control-label">Other</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="other"
                                   placeholder="Other Discount" name="other">
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




