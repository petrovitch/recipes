@extends('master')
@section('name', 'Detailed Statement')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings" style="width:100px">Acct</th>
                    <th class="text-center report-headings">Title/Description</th>
                    <th class="text-center report-headings" style="width:100px">Date</th>
                    <th class="text-center report-headings" style="width:100px">Document</th>
                    <th class="text-center report-headings" style="width:120px">Debit</th>
                    <th class="text-center report-headings" style="width:120px">Credit</th>
                    <th class="text-center report-headings" style="width:120px">Balance</th>
                </tr>
                </thead>
            </table>
            @foreach($glcoas as $glcoa)
                <table class="table table-bordered table-condensed table-striped">
                    <tbody>
                    <tr>
                        <td class="text-center" style="width:100px">{!! $glcoa->acct !!}</td>
                        <td class="text-left">{!! $glcoa->title !!}</td>
                        <td class="text-center" style="width:100px"> &nbsp; </td>
                        <td class="text-left" style="width:100px"> &nbsp; </td>
                        <td class="text-left" style="width:120px"> &nbsp; </td>
                        <td class="text-left" style="width:120px"> &nbsp; </td>
                        <td class="text-right" style="width:120px">{!! number_format($glcoa->init,2) !!}</td>
                    </tr>
                    <?php $total = $glcoa->init ?>
                    <?php $gltrns = DB::table('gltrns')->where('acct', $glcoa->acct)->get() ?>

                    @foreach($gltrns as $gltrn)
                        <?php
                        if ($gltrn->amount >= 0){
                            $debit = $gltrn->amount;
                            $credit = 0;
                        } else {
                            $debit = 0;
                            $credit = abs($gltrn->amount);
                        }
                        ?>
                        <tr>
                            <td class="text-left" style="width:100px"> &nbsp;</td>
                            <td class="text-left">{!! $gltrn->description !!}</td>
                            <td class="text-center" style="width:100px">{!! $gltrn->date !!}</td>
                            <td class="text-left" style="width:100px">{!! $gltrn->document !!}</td>
                            <td class="text-right" style="width:120px">{!! number_format($debit,2) !!}</td>
                            <td class="text-right" style="width:120px">{!! number_format($credit,2) !!}</td>
                            <td class="text-left" style="width:120px"> &nbsp; </td>
                        </tr>
                        <?php $total += $gltrn->amount ?>
                    @endforeach
                    <tr>
                        <td class="text-center" style="width:100px"></td>
                        <td class="text-left"> &nbsp; &nbsp; Total</td>
                        <td class="text-center" style="width:100px"> &nbsp; </td>
                        <td class="text-left" style="width:100px"> &nbsp; </td>
                        <td class="text-left" style="width:120px"> &nbsp; </td>
                        <td class="text-left" style="width:120px"> &nbsp; </td>
                        <td class="text-right" style="width:120px">{!! number_format($total,2) !!}</td>
                    </tr>
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
@endsection




