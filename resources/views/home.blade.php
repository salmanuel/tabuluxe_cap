@extends('base')

@section('content')

<div class="bg-dark shadow-lg">
    <div class="container py-3 px-4 rounded">
        <h4 class="font-weight-bold text-warning mb-0">Dashboard</h4>
    </div>
</div>

<div class="row d-flex align-items-stretch mt-4 justify-content-center">
    <div class="col-md-3 mb-3">
        <div class="card col d-flex flex-column justify-content-start align-items-center p-5 my-3">
            <h5 class="text-start mb-4">Total Events:</h5>
            <h4>{{ $totalEvents }}</h4>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card col d-flex flex-column justify-content-start align-items-center p-5 my-3">
            <h5 class="text-start mb-4">Total Contests:</h5>
            <h4>{{ $totalContests }}</h4>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card col d-flex flex-column justify-content-start align-items-center p-5 my-3">
            <h5 class="text-start mb-4">Total Judges:</h5>
            <h4>{{ $totalJudges }}</h4>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card col d-flex flex-column justify-content-start align-items-center p-5 my-3">
            <h5 class="text-start mb-4">Total Dancesports:</h5>
            <h4>{{ $totalDancesports }}</h4>
        </div>
    </div>
</div>


@endsection

<style scoped>
    .card {
        background-color: #080d32 !important;
        color: #ffbd59;
    }
    .text-start {
        text-align: start !important;
    }
</style>
