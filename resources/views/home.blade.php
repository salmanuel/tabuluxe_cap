@extends('base')

@section('content')

<div class="bg-dark shadow-lg">
    <div class="container py-3 px-4 rounded">
        <h3 class="font-weight-bold text-warning mb-0">Dashboard</h3>
    </div>
</div>

<div class="row d-flex align-items-stretch mt-4 justify-content-center">
    <div class="col-md-3 mb-3">
        <div class="card col d-flex justify-content-center align-items-center p-5 my-3">
            <h4>Total Events:</h4>
            <h3>{{ $totalEvents }}</h3>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card col d-flex justify-content-center align-items-center p-5 my-3">
            <h4>Total Contests:</h4>
            <h3>{{ $totalContests }}</h3>
        </div>
    </div>
</div>


@endsection

<style scoped>
    .card {
        background-color: #080d32 !important;
        color: #ffbd59;
    }
</style>
