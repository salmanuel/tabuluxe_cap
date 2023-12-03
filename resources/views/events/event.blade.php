@extends('base')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h1 class="title">Events</h1>
        <a href="{{ url('/events/create') }}" class="addbtn btn btn-lg">
            <i class="fa-solid fa-calendar-plus"></i>
        </a>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped custom-table" style="border-color: #6d6d6e;">
            <thead>
                <tr class="custom-table-row">
                    <th>Title</th>
                    <th class='text-center'>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr class="bg-white">
                    <td class="text-dark">{{$event->event_name}}</td>
                    <td class='text-center'>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$event->id}}">
                            Edit
                        </button>
                        @include('events.edit-event')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$event->id}}">
                            Delete
                        </button>
                        @include('events.delete-event')
                        <a href="{{url('/events/' . $event->id . '/contests')}}" class="btn btn-info">
                            <i class="fa-solid fa-folder-open"></i> Contests
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<style scoped>
.title {
    color:#1a202c;
    font-weight: bold;
    text-shadow: -1px -1px 0 #ffbd59, 1px -1px 0 #ffbd59, -1px 1px 0 #ffbd59, 1px 1px 0 #ffbd59;
    /* margin-bottom: 20px; */
}

.addbtn {
    background-color: #ffbd59 !important;
    color: #080d32 !important;
}

.addbtn:hover {
    background-color: #080d32 !important;
    color: #ffbd59 !important;
}

.custom-table-row {
    text-align: left;
    font-size: 0.9rem;
    font-weight: bold;
    color: #ffffff;
    text-transform: uppercase;
    background-color: #080d32;
}

.bg-white {
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.bg-white:hover {
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}

</style>
