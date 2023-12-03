@extends('base')

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h1 class="mt-2 title">Dancesports</h1>

        <a href="{{url('/dancesports/create')}}" class="addbtn btn btn-lg float-end">
            <i class="fa-solid fa-calendar-plus"></i>
        </a>
    </div>
    
    <table class="table table-bordered table-striped custom-table" style="border-color: #6d6d6e;">
        <thead>
            <tr class="custom-table-row">
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
            <tr class="bg-white">
                <td>{{$contest->title}}</td>
                <td>{{$contest->schedule}}</td>
                <td>{{$contest->venue}}</td>
                <td class='text-center'>
                    <button type="button" class="btn btn-primary p-1" data-bs-toggle="modal" data-bs-target="#editModal{{$contest->id}}">
                        Edit
                      </button>
                      @include('dancesports.edit-dancesport')
                    <button type="button" class="btn btn-danger p-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{$contest->id}}">
                        Delete
                      </button>
                      @include('dancesports.delete-dancesport')
                    <a href="{{url('/dancesports/' . $contest->id)}}" class="btn btn-sm btn-info">
                        <i class="fa-solid fa-folder-open"></i> View
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
    color:#1a202c;
    font-weight: bold;
    text-shadow: -1px -1px 0 #ffbd59, 1px -1px 0 #ffbd59, -1px 1px 0 #ffbd59, 1px 1px 0 #ffbd59;
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
