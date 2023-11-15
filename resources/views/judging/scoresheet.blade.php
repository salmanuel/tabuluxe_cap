@extends('base')

@section('content')

<div class="row">
    <div class="col">
        <h1 class="mb-0">{{$judge->contest->title}}</h1>
        <p>{{$judge->contest->venue}}</p>
    </div>
    <div class="col text-end">
        <h3 class="mb-0">Judge: {{$judge->name}}</h3>
        <a href="{{url('/judging/logout')}}" class="btn btn-danger btn-sm">
            Logout
        </a>
    </div>
</div>
<h3 class="text-center">Scoring Sheet</h3>
<hr>

{!! Form::open(['url'=>'/judging', 'method'=>'put']) !!}

<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-center bg-secondary text-light">
            <th>Contestants</th>
            @foreach($judge->contest->criterias as $criteria)
                <th>{{$criteria->name}} ({{$criteria->weight}})</th>
            @endforeach
            <th>Total</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        @foreach($judge->contest->contestants as $contestant)
        <tr>
            <td style="min-width: 30%">
                #{{$contestant->number}} - {{$contestant->name}} <br>
                {{$contestant->remarks}}
            </td>
            {!! Form::hidden("judge_id", $judge->id) !!}
            @foreach($judge->contest->criterias as $criteria)
                <?php $score = \App\Models\Score::get($judge->id, $criteria->id, $contestant->id); ?>
                <td>
                    {!! Form::number("score[$criteria->id][$contestant->id]",
                            $score->score,
                            ['class'=>'form-control','max'=>$criteria->weight,'min'=>0]) !!}
                </td>
            @endforeach
                <td class="text-center">{{\App\Models\Score::judgeTotal($judge->id, $contestant->id)}}</td>
                <td class="text-center">
                    {{$judge->rank($contestant)}}
                </td>
        </tr>
        @endforeach
    </tbody>
</table>

<button class="btn btn-success btn-lg mt-3">
    <i class="fa fa-save"></i> Save Changes
</button>
<span class="text-info">Note: Total and Rank will be updated after saving.</span>

{!! Form::close() !!}

@endsection
