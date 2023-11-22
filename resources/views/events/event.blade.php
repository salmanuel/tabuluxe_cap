@extends('base')

@section('content')

<a href="{{url('/events/create')}}" class="btn btn-success btn-lg float-end">
    Create Event
</a>
<h1 class="mt-4">Events</h1>
<hr>

<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-success text-white">
            <th>Title</th>

            <th class='text-center'>
                <i class="fa-solid fa-star-exclamation"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{$event->event_name}}</td>

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

@endsection
