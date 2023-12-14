@extends('base')

@section('content')


<div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="bg-login p-4 rounded">
            <div>
                <h1 class="text-center text-white mb-4 fs-4">Judge Login</h1>
                <hr class="bg-white">

                {!! Form::open(['url'=>'/judging/login', 'method'=>'post']) !!}
                @csrf
                <div class="mb-3">
                    {!! Form::label("passcode", "Judge Passcode", ['class' => 'text-white fs-6']) !!}
                    {!! Form::text("passcode", null, ['class'=>'form-control form-control-sm text-dark']) !!}
                </div>

                <button class="btn btn-primary btn-lg d-block mx-auto fs-6">
                    <i class="fa fa-sign-in me-2"></i>Login
                </button>
                {!! Form::close() !!}
            </div>
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
form input[type="password"],
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
