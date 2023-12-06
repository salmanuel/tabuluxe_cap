@extends('base')

@section('content')
<div class="mt-2">
    <div class="d-flex align-items-center">
        <h1 class="title">Preparation</h1> 
    </div>
    <hr>
    <div class="row d-flex justify-content-center align-items-stretch">
        <div class="col-md-7 mb-3">
            <div class="card h-100">
                <div class="card-body shadow">
                    <table class="table table-bordered table-striped sm">
                        <thead>
                            <tr class="bg-secondary text-light">
                                <th>Contestant</th>
                                <th>Sum Of Ranks</th>
                                <th>...</th>
                            </tr>
                        </thead>
                        <form method="post" action="{{url('/rounds/' . $round->next_round_id . '/' . $contest->id)}}">
                        <tbody>
                                @csrf
                            @foreach($data as $row)
                                <tr>
                                    <td>#{{$row['contestant']->number}} {{$row['contestant']->name}}</td>
                                    <td class="text-center">{{$row['sumOfRanks']}}</td>
                                    <td>
                                        <input type="checkbox" name="check[{{$row['contestant']->id}}]">
                                        <input type="hidden" name="name[{{$row['contestant']->id}}]" value="{{$row['contestant']->name}}">
                                        <input type="hidden" name="remarks[{{$row['contestant']->id}}]" value="{{$row['contestant']->remarks}}">
                                        <input type="hidden" name="number[{{$row['contestant']->id}}]" value="{{$row['contestant']->number}}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-center"><button class="btn btn-primary">Proceed to Next Round</button></td>
                            </tr>
                        </tfoot>
                        </form>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
    
@endsection