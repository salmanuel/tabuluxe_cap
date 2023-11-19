@extends('base')

@section('content')

<div class="row">
    <div class="col-md-4">
        <h1 class="mt-4">Create Event</h1>
        <hr>
        {!! Form::open(['url'=>'/events','method'=>'post']) !!}

        <div class="mb-3">
            {!! Form::label("event_name", "Event Name") !!}
            {!! Form::text("event_name", null, ['class'=>'form-control']) !!}
        </div>

        <button type="submit" class="btn btn-success btn-lg">Create Event</button>

        {!! Form::close() !!}
    </div>
</div>

@endsection
