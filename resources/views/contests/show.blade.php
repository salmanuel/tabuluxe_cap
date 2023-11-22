@extends('base')

@section('content')

<h1>{{$contest->title}} - Contest Title</h1>
<h1>{{$contest->computation}} - Contest Computation</h1>
<h1>{{$contest->event->event_name}} - Event</h1>
<hr>

<div class="row d-flex align-items-stretch">

    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body bg-light shadow">
                <div class="float-end">
                    @include('contests._add-judge')
                </div>
                <h3>Judges</h3>
                <hr>
                <table class="table table-bordered table-striped sm">
                    <thead>
                        <tr class="bg-secondary text-light">
                            <th>Judge</th>
                            <th>Pass Code</th>
                            <th>...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contest->judges as $judge)
                        <tr>
                            <td>{{$judge->name}}</td>
                            <td><span style="text-transform: uppercase; font-family:'Times New Roman', Times, serif">{{$judge->passcode}}</span></td>
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
    <div class="col-md-8 mb-3">
        <div class="card h-100">
            <div class="card-body bg-light shadow">
                <div class="float-end">
                    @include('contests._add-criteria')
                </div>
                <h3>Criterias</h3>
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
                            <td>
                                {{$criteria->name}}
                                <div class="text-muted fst-italic ms-2">{{$criteria->description}}</div>
                            </td>
                            <td class="text-center">{{$criteria->weight}}</td>
                            <td class="text-center">
                                <a href="{{url('/criterias/' . $criteria->id)}}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-folder-open"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td class="fw-bold">TOTAL</td>
                            <td class="text-center fw-bold">{{$total}}</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="float-end">
            @include('contests._add-contestant')
        </div>
        <h3>Contestants</h3>
        <hr>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-secondary text-light">
                    <th rowspan="2">Name</th>
                    @foreach($contest->judges as $judge)
                    <th class="text-center" colspan="2">{{$judge->name}}</th>
                    @endforeach
                    <th class="text-center" rowspan="2">Sum of Ranks</th>
                    <th class="text-center" rowspan="2">Final Rank</th>
                    <th rowspan="2" class="text-center">...</th>
                    <tr class="bg-secondary text-light">
                    @foreach($contest->judges as $judge)
                        <th class="text-center">Score</th>
                        <th class="text-center">Rank</th>
                    @endforeach

                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($computation as $id=>$row)

                <tr>
                    @foreach($row as $rw)
                        <td class="text-center">{!!$rw !!}</td>
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

@endsection
