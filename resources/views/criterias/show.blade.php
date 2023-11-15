<?php

$judges = $criteria->contest->judges;

?>

@extends('base')

@section('content')

<div class="float-end mt-3">
    <a href="{{url('/contests/' . $criteria->contest->id)}}" class="btn btn-success">
        <i class="fa fa-arrow-left"></i> Back to contest
    </a>
</div>

<h1 class="mb-0">Criteria: {{$criteria->name}}</h1>
<p>
    <div class="d-inline-block">{{$criteria->contest->title}}</div>
    <div class="d-inline-block">{{$criteria->contest->schedule}}</div>
    <div class="d-inline-block">{{$criteria->contest->venue}}</div>
</p>
<hr>

<div class="row">
    <div class="col-md-3">
        {!! Form::model($criteria, ['url'=>'/criterias/' . $criteria->id, 'method'=>'put']) !!}

        <div class="mb-3">
            {!! Form::label("name") !!}
            {!! Form::text("name", null, ['class'=>'form-control']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("description") !!}
            {!! Form::textarea("description", null, ['class'=>'form-control','rows'=>'3']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("weight") !!}
            {!! Form::number("weight", null, ['class'=>'form-control']) !!}
        </div>

        <button class="btn btn-success" type="submit">
            <i class="fa fa-save"></i> Save Changes
        </button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <h3>Scoring Summary: {{$criteria->name}}</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-success text-light">
                    <th rowspan="2">Contestants</th>
                    <th colspan="{{count($judges)}}">Judges</th>
                    <th rowspan="2" class="text-center">Average</th>
                </tr>
                <tr class="bg-success text-light">
                    @foreach($judges as $judge)
                        <th class="text-center">{{$judge->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($judge->contest->contestants as $contestant)
                <?php $total = 0; ?>
                <tr>
                    <td>{{$contestant->name}}</td>
                    @foreach($judges as $judge)
                    <td class="text-center">{{$score = \App\Models\Score::get($judge->id,$criteria->id,$contestant->id)->score}}</td>
                    <?php $total += $score; ?>
                    @endforeach
                    <td class="text-center">{{number_format($total/count($judges), 2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
