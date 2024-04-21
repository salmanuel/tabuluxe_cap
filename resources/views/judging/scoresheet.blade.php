@extends('base')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col">
            <h1 class="mb-0 title">{{$judge->contest->title}}</h1>
            <p class="text-white">Venue: {{$judge->contest->venue}}</p>
        </div>
        <div class="col text-end">
            <h3 class="mb-0 title">Judge: {{$judge->name}}</h3>
            <a href="{{url('/judging/logout')}}" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>
    </div>
    <h3 class="text-center mt-4 mb-3 title">Scoring Sheet</h3>
    <hr class="text-white">

    {!! Form::open(['url'=>'/judging', 'method'=>'put']) !!}

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="custom-table-row">
                    <th>Contestants</th>
                    @foreach($judge->contest->getActiveRound()->criterias as $criteria)
                        <th style="min-width: 50px">{{$criteria->name}} ({{$criteria->weight}})</th>
                    @endforeach
                    <th>Total</th>
                    @if($judge->contest->computation === "Ranking")
                    <th>Rank</th>
                    @endif

                    @if($judge->contest->computation === "Average")
                    <th>Average</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($judge->contest->getActiveRound()->contestants as $contestant)
                <tr class="text-white">
                    <td class="text-white" style="min-width: 30%">
                        #{{$contestant->number}} - {{$contestant->name}} <br>
                        {{$contestant->remarks}}
                    </td>
                    {!! Form::hidden("judge_id", $judge->id) !!}
                    @foreach($judge->contest->getActiveRound()->criterias as $criteria)
                        <?php $score = \App\Models\Score::get($judge->id, $criteria->id, $contestant->id); ?>
                        {{-- @php
                            dd($judge->id, $criteria->id, $contestant->id)
                        @endphp --}}
                        <td>
                            {!! Form::number("score[$criteria->id][$contestant->id]",
                                    $score->score,
                                    ['class'=>'form-control','max'=>$criteria->weight,'min'=>0, 'step'=>'0.1']) !!}
                        </td>
                    @endforeach
                        <td class="text-center text-white">{{\App\Models\Score::judgeTotal($judge->id, $contestant->id)}}</td>

                        @if($judge->contest->computation === "Ranking")
                        <td class="text-center text-white">
                            {{$judge->rank($contestant)}}
                        </td>
                        @endif

                        @if($judge->contest->computation === "Average")
                        <td class="text-center text-white">
                            @php
                                $totalScore = \App\Models\Score::judgeTotal($judge->id, $contestant->id);
                                $averageScore = count($judge->contest->judges) > 0 ? $totalScore / count($judge->contest->judges) : 0;
                                echo number_format((float)$averageScore, 2, '.', ''); // Displaying average score with 2 decimal places
                            @endphp
                        </td>
                        @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button class="btn btn-success btn-lg mt-3">
        <i class="fa fa-save"></i> Save Changes
    </button>
    <span class="text-info">Note: Total and Rank will be updated after saving.</span>

    {!! Form::close() !!}

</div>
@endsection

<style scoped>
.title {
    color:#1a202c;
    font-weight: bold;
    text-shadow: -1px -1px 0 #ffbd59, 1px -1px 0 #ffbd59, -1px 1px 0 #ffbd59, 1px 1px 0 #ffbd59;
}

.custom-table-row {
    text-align: left;
    font-size: 0.85rem;
    font-weight: bold;
    color: #ffffff;
    text-transform: uppercase;
    background-color: #1a202c;
}

.table {
    color: #ffffff;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #29303c;
}

.btn {
    color: #ffffff;
}

.btn-danger {
    background-color: #d9534f;
    border-color: #d43f3a;
}

.btn-danger:hover {
    background-color: #c9302c;
    border-color: #ac2925;
}

.btn-success {
    background-color: #5cb85c;
    border-color: #4cae4c;
}

.btn-success:hover {
    background-color: #4cae4c;
    border-color: #398439;
}
</style>
