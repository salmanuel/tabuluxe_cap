<?php $criterias = $contestant->contest->criterias; ?>

@extends('base')

@section('content')

<div class="float-end mt-3">
    <a href="{{url('/contests/' . $contestant->contest->id)}}" class="btn btn-success">
        <i class="fa fa-arrow-left"></i> Back to Contest
    </a>
</div>

<h1 class="mb-0">{{$contestant->name}}</h1>
<p>
    {{$contestant->contest->title}}
    {{$contestant->contest->schedule}} - {{$contestant->contest->venue}}
</p>
<hr>

<div class="row">
    <div class="col-md-3">
        {!! Form::model($contestant, ['url'=>'/contestants/' . $contestant->id, 'method'=>'put']) !!}

        <div class="mb-3">
            {!! Form::label("number",'Contestant Number') !!}
            {!! Form::number("number", null, ['class'=>'form-control']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("name") !!}
            {!! Form::text("name", null, ['class'=>'form-control']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("remarks") !!}
            {!! Form::text("remarks", null, ['class'=>'form-control']) !!}
        </div>

        <button class="btn btn-success" type="submit">
            <i class="fa fa-save"></i> Save Changes
        </button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <h3>Scoring Summary</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-success text-light">
                    <th rowspan="2">Judge</th>
                    <th colspan="{{count($criterias)}}">Criteria</th>
                    <th rowspan="2" class="text-center">TOTAL</th>
                    <th rowspan="2" class="text-center">Rank</th>
                </tr>
                <tr class="bg-success text-light">
                    @foreach($criterias as $criteria)
                        <th>{{$criteria->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($contestant->contest->judges as $judge)
                <tr>
                    <?php $total = 0; ?>
                    <td>{{$judge->name}}</td>
                    @foreach($criterias as $criteria)
                        <td class="text-center">{{$score = \App\Models\Score::get($judge->id, $criteria->id, $contestant->id)->score}}</td>
                        <?php $total += $score; ?>
                    @endforeach
                    <td class="text-center">{{$total}}</td>
                    <td class="text-center">{{$judge->rank($contestant)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
