@extends('base')

@section('content')
<div class="mt-2">
    <div class="d-flex align-items-center">
        <h1 class="title">{{$contest->title}}</h1> 
        <button type="button" class="btn btn-secondary" data-toggle="popover" title="This contest has a {{$contest->computation}} computation method and belongs to the event named {{$contest->event->event_name}}." data-content="Popover content"><i class="fa-solid fa-circle-info"></i></button>
    </div>
    <hr>
</div>


<div class="row d-flex align-items-stretch">
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body shadow">
                <div class="float-end">
                    @include('contests._add-round')
                </div>
                <h5>Rounds</h5>
                <hr>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th>Round</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contest->rounds as $round)
                        <tr>
                            <td  class="text-white text-center">
                                Round {{$round->number}}
                            </td>
                            <td class="text-center text-white">{{$round->description}}</td>
                            <td class="text-center">
                                <a href="{{url('/rounds/' . $round->id . '/' .$contest->id)}}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-folder-open"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-3">
        <div class="card h-100">
            <div class="card-body shadow">
                <div class="float-end">
                    @include('contests._add-judge')
                </div>
                <h5>Judges</h5>
                <hr>
                <table class="table table-bordered table-striped sm">
                    <thead>
                        <tr class="bg-secondary text-light">
                            <th>Judge</th>
                            <th>Passcode</th>
                            <th class="text-center">...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contest->judges as $judge)
                        <tr>
                            <td  class="text-white">{{$judge->name}}</td>
                            <td  class="text-white"><span style="text-transform: uppercase; font-family:'Times New Roman', Times, serif">{{$judge->passcode}}</span></td>
                            <td class="text-center">
                                <a href="{{url('/judges/' . $judge->id)}}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-folder-open"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    {{-- <div class="col-md-8 mb-3">
        <div class="card h-100">
            <div class="card-body shadow">
                <div class="float-end">
                    @include('contests._add-criteria')
                </div>
                <h5>Criterias</h5>
                <hr>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th>Criteria</th>
                            <th class="text-center">Weight</th>
                            <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @foreach($contest->criterias as $criteria)
                        <?php $total+=$criteria->weight; ?>
                        <tr>
                            <td  class="text-white">
                                {{$criteria->name}}
                                <div class="text-muted fst-italic ms-2">{{$criteria->description}}</div>
                            </td>
                            <td class="text-center text-white">{{$criteria->weight}}</td>
                            <td class="text-center">
                                <a href="{{url('/criterias/' . $criteria->id)}}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-folder-open"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="fw-bold text-white">TOTAL</td>
                            <td class="text-center fw-bold text-white">{{$total}}</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
</div>

<div class="row d-flex align-items-stretch">

    {{-- <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-body shadow">
                <div class="float-end">
                    @include('contests._add-contestant')
                </div>
                <h5>Contestants</h5>
                <hr>
                <table class="table table-bordered table-striped sm">
                    <thead>
                        <tr class="bg-secondary text-light">
                            <th>Name</th>
                            <th>Remarks</th>
                            <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contest->contestants as $contestant)
                        <tr>
                            <td  class="text-white">#{{$contestant->number}} {{$contestant->name}}</td>
                            <td  class="text-white"><span style="text-transform: uppercase; font-family:'Times New Roman', Times, serif">{{$contestant->remarks}}</span></td>
                            <td class="text-center">
                                <a href="{{url('/contestants/' . $contestant->id)}}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-folder-open"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
    
</div>
{{-- @if($contest->computation === 'Averaging')
@foreach ($contest->rounds as $round)
<div class="row">
    <div class="col">
        <div class="float-end">
            @include('contests._add-contestant')
        </div>
        <h3 class="con_rounds">Contestants Score - Round {{$round->rounds}}</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="custom-table-row">
                    <th rowspan="2">Name</th>
                    @foreach($contest->judges as $judge)
                    <th class="text-center" colspan="2">{{$judge->name}}</th>
                    @endforeach
                    <th class="text-center" rowspan="2">Sum of Ranks</th>
                    <th class="text-center" rowspan="2">Final Rank</th>
                    <th rowspan="2" class="text-center">...</th>
                    <tr class="custom-table-row">
                    @foreach($contest->judges as $judge)
                        <th class="text-center">Score</th>
                        <th class="text-center">Rank</th>
                    @endforeach

                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($computation as $id=>$row)

                <tr class="text-white">
                    @foreach($row as $rw)
                        <td class="text-center text-white">{!!$rw !!}</td>
                    @endforeach
                    <td class="text-center">
                        <a href="{{url('/contestants/' . $id)}}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-folder-open"></i>
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endforeach --}}
{{-- @endif --}}

<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>

@endsection

<style scoped>
.title {
    color:#1a202c;
    font-weight: bold;
    text-shadow: -1px -1px 0 #ffbd59, 1px -1px 0 #ffbd59, -1px 1px 0 #ffbd59, 1px 1px 0 #ffbd59;
}

.custom-table-row {
    text-align: left;
    font-size: 0.75rem; 
    line-height: 1.5rem; 
    font-weight: bold; 
    color: #ffffff; 
    text-transform: uppercase; 
    letter-spacing: 0.1em; 
    background-color: #1a202c;
}

.card-body {
    background-color: #1a202c;
    color: #ffffff
}

.con_rounds {
    color:#1a202c;
    font-weight: bold;
    text-shadow: -1px -1px 0 #ffbd59, 1px -1px 0 #ffbd59, -1px 1px 0 #ffbd59, 1px 1px 0 #ffbd59;
}
</style>
