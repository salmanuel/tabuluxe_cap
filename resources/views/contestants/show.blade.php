<?php $criterias = $contestant->round->criterias; ?>
<?php $contest = $contestant->round->contest; ?>

@extends('base')

@section('content')

<div class="float-end mt-3">
    <div class="float-end mt-3">
        <a href="{{url('/rounds/' . $contestant->round->id . '/' . $contestant->round->contest->id)}}" class="btn btn-warning">
            <i class="fa fa-arrow-left"></i> Back to {{ $contestant->round->description }}
        </a>
    </div>
</div>

<h1 class="mb-0 title">{{$contestant->name}}</h1>
<p class="text-white">
    {{$contestant->round->contest->title}} <br>
    {{$contestant->round->contest->schedule}} - {{$contestant->round->contest->venue}}
</p>
<hr>

<div class="row justify-content-center mt-5 vh-100">
    <div class="col-md-4">
        <div class=" bg-login p-4 rounded">
        {!! Form::model($contestant, ['url'=>'/contestants/' . $contestant->id, 'method'=>'put']) !!}

        <div class="mb-3">
            {!! Form::label("number",'Contestant Number') !!}
            {!! Form::number("number", null, ['class'=>'form-control text-dark']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("name") !!}
            {!! Form::text("name", null, ['class'=>'form-control text-dark']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("remarks") !!}
            {!! Form::text("remarks", null, ['class'=>'form-control text-dark']) !!}
        </div>
        <div class="d-flex justify-content-between">
            
            <button class="btn btn-save" type="submit">
                <i class="fa fa-save"></i> Save Changes
            </button>
    
        {!! Form::close() !!}
    
            <div>
                <button type="button" class="btn btn-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{$contestant->id}}">
                    <i class="fa-solid fa-trash"></i>
                    Delete Contestant
                  </button>
                  @include('contestants.delete-contestant')
            </div>
        </div>

        </div>
    </div>  
</div>


    {{-- <div class="col-md-9">
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
                @foreach($contestant->round->contest->judges as $judge)
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
    </div> --}}
{{-- </div> --}}

@endsection

<style scoped>
    .title {
        color:#1a202c;
        font-weight: bold;
        text-shadow: -1px -1px 0 #ffbd59, 1px -1px 0 #ffbd59, -1px 1px 0 #ffbd59, 1px 1px 0 #ffbd59;
    }
    
    form {
        color: #fff;
    }
    
    .bg-login {
        background-color: #080d32;
    }
    
    
    form input[type="text"],
    form label {
        color: #fff; 
    }
    
    .btn-save {
        background-color: #ffc107 !important;
        color: #080d32 !important;
        /* border-color: #28a745; */
    }
    
    .btn-warning:hover {
        background-color: #080d32 !important;
        color: white !important;
    }
    
    .btn-save:hover {
        background-color: #6c757d !important;
        border-color: #ffc107;
        color: white !important;
    }
    
    .form-label {
        color: #fff;
        margin-bottom: 0.5rem;
    }
    </style>
