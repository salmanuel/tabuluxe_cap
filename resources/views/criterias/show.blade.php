{{-- <?php

$judges = $criteria->contest->judges;

?> --}}

@extends('base')

@section('content')

<div class="float-end mt-3">
    <a href="{{url('/rounds/' . $criteria->round->id . '/' . $criteria->round->contest->id)}}" class="btn btn-warning">
        <i class="fa fa-arrow-left"></i> Back to {{$criteria->round->description}}
    </a>
</div>

<h1 class="mb-0 title">Criteria: {{$criteria->name}}</h1>
<p>
    <div class="d-inline-block text-white">{{$criteria->round->contest->title}}</div>
    <div class="d-inline-block text-white">{{$criteria->round->contest->schedule}}</div>
    <div class="d-inline-block text-white">{{$criteria->round->contest->venue}}</div>
</p>
<hr>

<div class="row justify-content-center mt-5 vh-100">
    <div class="col-md-4">
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
    
        {!! Form::close() !!}
    
            <div>
                <button type="button" class="btn btn-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{$criteria->id}}">
                    <i class="fa-solid fa-trash"></i>
                    Delete Criteria
                  </button>
                  @include('criterias.delete-criteria')
            </div>
        </div>
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
