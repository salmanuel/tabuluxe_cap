@extends('base')

@section('content')
<div>
    <a href="{{url('/events/create')}}" class="addbtn btn btn-lg float-end">
        <i class="fa-solid fa-calendar-plus"></i>
    </a>
    <h1 class="mt-4 title">Events</h1>
    <hr>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="custom-table-row">
                <th>Title</th>
    
                <th class='text-center'>
                    {{-- <i class="fa-solid fa-star-exclamation"></i> --}}
                    ...
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td class="text-white">{{$event->event_name}}</td>
    
                {{-- <td>{{$event->schedule}}</td>
                <td>{{$event->venue}}</td> --}}
                <td class='text-center'>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$event->id}}">
                        Edit
                      </button>
                      @include('events.edit-event')
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$event->id}}">
                        Delete
                      </button>
                      @include('events.delete-event')
                    <a href="{{url('/events/' . $event->id . '/contests')}}" class="btn btn-sm btn-info">
                        <i class="fa-solid fa-folder-open"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

@endsection


<style scoped>
.title {
    color: #ffbd59;
}

.addbtn {
    background-color: #ffbd59 !important;
}

.addbtn:hover {
    background-color: #080d32 !important;
    color: #ffbd59 !important;

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
</style>