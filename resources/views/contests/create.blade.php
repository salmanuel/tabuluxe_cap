@extends('base')

@section('content')

<div class="row">
    <div class="col-md-4">
        <h1 class="mt-4">Create Contest</h1>
        <hr>
        {!! Form::open(['url'=>'/contests','method'=>'post']) !!}

        <div class="mb-3">
            {!! Form::label("title", "Title") !!}
            {!! Form::text("title", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label("schedule") !!}
            {!! Form::text("schedule", null, ['class'=>'form-control']) !!}
        </div>
        <div class="mb-3">
            {!! Form::label("venue") !!}
            {!! Form::text("venue", null, ['class'=>'form-control']) !!}
        </div>

        <button type="submit" class="btn btn-success btn-lg">Create Contest</button>

        {!! Form::close() !!}
    </div>
</div>

@endsection
