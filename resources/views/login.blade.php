@extends('base')

@section('content')

<div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <h1 class="text-center">Admin Login</h1>
        <hr>
        {!! Form::open(['url'=>'/login', 'method'=>'post']) !!}

        <div class="mb-3">
            {!! Form::label("email", "User Name") !!}
            {!! Form::text("email", null, ['class'=>'form-control']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("password") !!}
            {!! Form::password("password", ['class'=>'form-control']) !!}
        </div>

        <button class="btn btn-success btn-lg d-block mx-auto">
            <i class="fa fa-sign-in"></i> Login
        </button>

        {!! Form::close() !!}
    </div>
</div>

@endsection
