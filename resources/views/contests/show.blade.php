@extends('base')

@section('content')
<div class="mt-2">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <h1 class="title">{{$contest->title}}</h1> 
            <button type="button" class="btn btn-secondary" data-toggle="popover" title="This contest has a {{$contest->computation}} computation method and belongs to the event named {{$contest->event->event_name}}." data-content="Popover content"><i class="fa-solid fa-circle-info"></i></button>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{url('/events/' . $contest->event->id .'/contests')  }}" class="btn btn-warning">Back</a>
        </div>
    </div>
    <hr>
</div>


<div class="row d-flex align-items-stretch">
    <div class="col-md-5 mb-3">
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
                                <a href="{{url('/rounds/' . $round->id)}}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-pen-to-square"></i>
                                </a>

                                {{-- <a href="{{url('/rounds/' . $round->id)}}" class="btn btn-sm btn-secondary px-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> --}}
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
    <div class="col-md-7 mb-3">
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
    
</div>


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
