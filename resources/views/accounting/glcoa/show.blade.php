@extends('master')
@section('name', 'Show Account')

@section('content')
    <div class="container col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center report-headings">Acct</th>
                    <th class="text-center report-headings">Title/Description</th>
                    <th class="text-center report-headings">CRJ</th>
                    <th class="text-center report-headings">Date</th>
                    <th class="text-center report-headings">Document</th>
                    <th class="text-center report-headings">Debit</th>
                    <th class="text-center report-headings">Credit</th>
                    <th class="text-center report-headings">Balance</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center" style="width:100px">{!! $glcoa->acct !!}</td>
                    <td class="text-left">{!! $glcoa->title !!}</td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-right" style="width:120px">{!! number_format($glcoa->init,2) !!}</td>
                </tr>
                    <?php $total = $glcoa->init ?>
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
                            <td class="text-center" style="width:100px">{!! $gltrn->crj !!}</td>
                            <td class="text-center" style="width:100px">{!! $gltrn->date !!}</td>
                            <td class="text-left" style="width:100px">{!! $gltrn->document !!}</td>
                            <td class="text-right" style="width:120px">{!! number_format($debit,2) !!}</td>
                            <td class="text-right" style="width:120px">{!! number_format($credit,2) !!}</td>
                            <td class="text-left"> &nbsp; </td>
                        </tr>
                        <?php $total += $gltrn->amount ?>
                    @endforeach
                <tr>
                    <td class="text-center" style="width:100px"></td>
                    <td class="text-left"> &nbsp; &nbsp; Total</td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-left"> &nbsp; </td>
                    <td class="text-right" style="width:120px">{!! number_format($total,2) !!}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection




