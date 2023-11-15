@extends('base')

@section('content')

<h1>Judging Module</h1>
<hr>

<div class="row">
    <div class="col-md-4">
        {!! Form::open(['url'=>'/judging/login', 'method'=>'post']) !!}
            {!! Form::label("passcode", "Judge Pass Code") !!}
            {!! Form::text("passcode", null, ['class'=>'form-control']) !!}

            <button class="btn btn-success btn-lg mt-3">
                Judge Login
            </button>
        {!! Form::close() !!}
    </div>
</div>

@endsection
