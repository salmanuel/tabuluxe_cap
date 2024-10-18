@php use \App\Models\Score; @endphp

@extends('base')

@section('content')

@include('criterias.delete-criteria')

<div class="float-end mt-3">
    <a href="{{url('/rounds/' . $criteria->round->id . '/' . $criteria->round->contest->id)}}" class="btn btn-warning">
        <i class="fa fa-arrow-left"></i> Back to {{$criteria->round->description}}
    </a>
</div>

<div class="px-4">
    <h1 class="mb-0 title">Criteria: {{$criteria->name}}</h1>
    <p>
        <div class="d-inline-block text-white">{{$criteria->round->contest->title}}</div>
        <div class="d-inline-block text-white">{{$criteria->round->contest->schedule}}</div>
        <div class="d-inline-block text-white">{{$criteria->round->contest->venue}}</div>
    </p>
</div>

<hr>

<div class="p-4 row">
    <div class="col-md-3">
        <div class=" bg-login p-4 rounded">
            {!! Form::model($criteria, ['url'=>'/criterias/' . $criteria->id, 'method'=>'put']) !!}

            <div class="mb-3">
                {!! Form::label("name", "Name", ['class' => 'form-label']) !!}
                {!! Form::text("name", null, ['class'=>'form-control text-dark']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("description", "Description", ['class' => 'form-label']) !!}
                {!! Form::textarea("description", null, ['class'=>'form-control text-dark','rows'=>'3']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label("weight", "Weight", ['class' => 'form-label']) !!}
                {!! Form::number("weight", null, ['class'=>'form-control text-dark']) !!}
            </div>


            <div class="d-flex justify-content-between">

                <button class="btn btn-save" type="submit">
                    <i class="fa fa-save"></i> Save Changes
                </button>

                <div>
                    <button type="button" class="btn btn-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{$criteria->id}}">
                        <i class="fa-solid fa-trash"></i>
                        Delete Criteria
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-md-9 bg-login rounded text-white p-4">
        <h3>Scoring Summary</h3>
        <table class="table table-bordered">
            <thead>
                <tr class="bg-info text-center">
                    <th>Contestant</th>
                    @foreach($criteria->round->contest->judges as $index=>$judge)
                        <th title="{{ $judge->name }}">{{ $index+1 }}</th>
                    @endforeach
                    <th>Avg</th>
                </tr>
            </thead>
            <tbody>
                @foreach($summary as $id=>$row)
                    <tr class="@if($row['average']==$highestRow) bg-primary fw-bold text-white @else bg-warning @endif">
                        <td>#{{ $row['contestant']->number }}.
                            {{ $row['contestant']->name }}</td>
                        @foreach($row['scores'] as $score)
                            <td class="text-center">{{ $score }}</td>
                        @endforeach
                        <td class="text-center">{{ $row['average'] }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>


</div>

</div>


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
form label,
form textarea,
form button {
    color: #fff;
}

.btn-save {
    background-color: #ffc107 !important;
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
