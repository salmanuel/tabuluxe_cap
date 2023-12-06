@extends('base')

@section('content')

<div class="float-end mt-3">
    <a href="{{url('/contests/' . $judge->contest->id)}}" class="btn btn-success">
        <i class="fa fa-arrow-left"></i> Back to Contest
    </a>
</div>
<h1 class="mb-0">Judge {{$judge->name}}</h1>
<p>
    <div class="d-inline-block">{{$judge->contest->title}}</div>
    <div class="d-inline-block">{{$judge->contest->schedule}}</div>
    <div class="d-inline-block">{{$judge->contest->venue}}</div>
</p>

<hr>
<div class="row justify-content-center mt-5 vh-100">
    <div class="col-md-4">
        <div class=" bg-login p-4 rounded">
            {!! Form::model($judge, ['url'=>'/judges/' . $judge->id, 'method'=>'put']) !!}

            <div class="mb-3">
                {!! Form::label("name", "Judge Name", ['class' => 'form-label']) !!}
                {!! Form::text("name", null, ["class"=>'form-control']) !!}
            </div>
    
            <div class="mb-3">
                {!! Form::label("passcode","Pass Code", ['class' => 'form-label']) !!}
                {!! Form::text("passcode", null, ["class"=>'form-control']) !!}
            </div>
    
            <button class="btn btn-success">
                <i class="fa fa-save"></i>
                Save Changes
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

/* Adjust label styles */
.form-label {
    color: #fff;
    margin-bottom: 0.5rem;
}
</style>
