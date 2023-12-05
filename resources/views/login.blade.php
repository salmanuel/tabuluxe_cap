@extends('base')

@section('content')

<div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-4">
        <div class="bg-login p-4 rounded">
            <div>
                <h1 class="text-center text-warning mb-4 fs-4">Admin Login</h1>
                <hr class="bg-white">

                {!! Form::open(['url'=>'/login', 'method'=>'post']) !!}

                <div class="mb-3">
                    {!! Form::label("email", "Username", ['class' => 'text-warning fs-6']) !!}
                    {!! Form::text("email", null, ['class'=>'form-control form-control-sm']) !!}
                </div>

                <div class="mb-3">
                    {!! Form::label("password", "Password", ['class' => 'text-warning fs-6']) !!}
                    {!! Form::password("password", ['class'=>'form-control form-control-sm']) !!}
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
    color: #ffffff; /* Text color for inputs and labels */
}

/* Override button color */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

/* Hover effect for the button */
.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}
</style>
