@extends('base')

@section('content')

<div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="bg-login p-4 rounded">
            <h1 class="text-center text-white mb-4 fs-4">Create Event</h1>
            <hr class="bg-white">

            {!! Form::open(['url'=>'/events','method'=>'post']) !!}

            <div class="mb-3">
                {!! Form::label("event_name", "Event Name", ['class' => 'text-white fs-6']) !!}
                {!! Form::text("event_name", null, ['class'=>'form-control form-control-sm text-dark']) !!}
            </div>

            <button type="submit" class="btn btn-warning btn-lg d-block mx-auto fs-6">
                Create Event
            </button>

            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

<style scoped>
form {
    color: #fff;
}

.bg-login {
    background-color: #080d32;
}

/* Styling for the form elements */
form input[type="text"],
form label {
    color: #fff; /* Text color for inputs and labels */
}

/* Override button color */
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

/* Hover effect for the button */
.btn-success:hover {
    background-color: #218838;
    border-color: #218838;
}
</style>
