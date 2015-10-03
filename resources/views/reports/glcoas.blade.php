@extends('reports.master')
@section('content')
    <table class="table" style="background-color:white">
        <thead>
        <tr>
            <th class="text-center report-headings">Acct</th>
            <th class="text-center report-headings">Title</th>
            <th class="text-center report-headings">Opening</th>
            <th class="text-center report-headings">Change</th>
            <th class="text-center report-headings">Balance</th>
            <th class="text-center report-headings">Created</th>
            <th class="text-center report-headings">Modified</th>
        </tr>
        </thead>
        <tbody>
        @foreach($glcoas as $glcoa)
            <?php
            $results = DB::select(DB::raw("SELECT SUM(amount) AS total, COUNT(amount) AS count FROM gltrns WHERE acct = " . $glcoa->acct));
            $count = $results[0]->count;
            $change = $results[0]->total;
            $balance = $glcoa->init + $change;
            ?>
            <tr>
                <td class="text-center">{!! $glcoa->acct !!}</td>
                <td class="text-left">{!! $glcoa->title !!}</td>
                <td class="text-right">{!! number_format($glcoa->init,2) !!}</td>
                <td class="text-right">{!! number_format($change,2) !!}</td>
                <td class="text-right">{!! number_format($balance,2) !!}</td>
                <td class="text-center">{!! $glcoa->created_at !!}</td>
                <td class="text-center">{!! $glcoa->updated_at !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

