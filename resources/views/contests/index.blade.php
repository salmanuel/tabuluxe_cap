@extends('base')

@section('content')

<a href="{{ url('/events/' . $eventId . '/contests/create') }}" class="btn btn-success btn-lg float-end">
    Create Contest
</a>
<h1 class="mt-4">My Contests</h1>
<hr>

<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-success text-white">
            <th>Title</th>
            <th>Schedule</th>
            <th>Venue</th>
            <th class='text-center'>
                <i class="fa-solid fa-star-exclamation"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($contests as $contest)
        <tr>
            <td>{{$contest->title}}</td>
            <td>{{$contest->schedule}}</td>
            <td>{{$contest->venue}}</td>
            <td class='text-center'>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$contest->id}}">
                    Edit
                  </button>
                  @include('contests.edit-contest')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$contest->id}}">
                    Delete
                  </button>
                  @include('contests.delete-contest')
                <a href="{{url('/contests/' . $contest->id)}}" class="btn btn-sm btn-info">
                    <i class="fa-solid fa-folder-open"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
