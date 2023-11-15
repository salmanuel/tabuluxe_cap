@extends('base')

@section('content')

<div class="float-end mt-3">
    <a href="{{url('/contests/' . $judge->contest->id)}}" class="btn btn-success">
        <i class="fa fa-arrow-left"></i> Back to Contest
    </a>
</div>
<h1 class="mb-0">Judge {{$judge->name}}</h1>
<p>
    <div class="d-inline-block">{{$judge->contest->title}}</div>
    <div class="d-inline-block">{{$judge->contest->schedule}}</div>
    <div class="d-inline-block">{{$judge->contest->venue}}</div>
</p>

<hr>
<div class="row">
    <div class="col-md-3">
        {!! Form::model($judge, ['url'=>'/judges/' . $judge->id, 'method'=>'put']) !!}

        <div class="mb-3">
            {!! Form::label("name") !!}
            {!! Form::text("name", null, ["class"=>'form-control']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("passcode","Pass Code") !!}
            {!! Form::text("passcode", null, ["class"=>'form-control']) !!}
        </div>

        <button class="btn btn-success">
            <i class="fa fa-save"></i>
            Save Changes
        </button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <h3>Scoring</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-success text-light">
                    <th>Contestant</th>
                    @foreach($judge->contest->criterias as $criteria)
                        <th class="text-center">
                            {{$criteria->name}}({{$criteria->weight}})
                        </th>
                    @endforeach
                    <th class="text-center">Total</th>
                    <th class="text-center">Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach($judge->contest->contestants as $contestant)

                <tr>
                    <td>{{$contestant->name}}</td>
                    @foreach($judge->contest->criterias as $criteria)
                        <td class="text-center">{{\App\Models\Score::get($judge->id, $criteria->id, $contestant->id)->score}}</td>
                    @endforeach
                    <td class="text-center">{{\App\Models\Score::judgeTotal($judge->id, $contestant->id)}}</td>
                    <td class="text-center">{{$judge->rank($contestant)}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
