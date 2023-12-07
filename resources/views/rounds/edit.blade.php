@extends('base')

@section('content')

<div class="float-end mt-3">
    <a href="{{url('/contests/' . $round->contest->id)}}" class="btn btn-warning">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>
<h1 class="mb-0 title">Round {{$round->number}}</h1>
{{-- <p>
    <div class="d-inline-block">{{$judge->contest->title}}</div>
    <div class="d-inline-block">{{$judge->contest->schedule}}</div>
    <div class="d-inline-block">{{$judge->contest->venue}}</div>
</p> --}}

<hr>
<div class="row justify-content-center mt-5 vh-100">
    <div class="col-md-4">
        <div class=" bg-login p-4 rounded">
            {!! Form::model($round, ['url'=>'/rounds/' . $round->id, 'method'=>'put']) !!}

            <div class="mb-3">
                {!! Form::label("number", "Round Number", ['class' => 'form-label']) !!}
                {!! Form::text("number", null, ["class"=>'form-control text-dark']) !!}
            </div>
    
            <div class="mb-3">
                {!! Form::label("description","Description", ['class' => 'form-label']) !!}
                {!! Form::text("description", null, ["class"=>'form-control text-dark']) !!}
            </div>
            
            <div class="d-flex justify-content-end">
                <div>
                    <button class="btn btn-warning p-2">
                        <i class="fa fa-save"></i>
                        Save Changes
                    </button>
                </div>
            {!! Form::close() !!}
                {{-- <div class> --}}
                    {{-- <form method="POST" action="{{ route('rounds.destroy', ['round' => $round->id, 'contest' => $round->contest->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger p-2">
                            <i class="fa-solid fa-trash"></i>
                            Delete round 
                        </button>
                    </form> --}}
                    {{-- <button type="button" class="btn btn-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{$round->id}}">
                        <i class="fa-solid fa-trash"></i>
                        Delete round
                      </button>
                      @include('rounds.delete-rounds')
                </div> --}}
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
