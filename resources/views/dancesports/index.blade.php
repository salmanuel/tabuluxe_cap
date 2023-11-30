@extends('base')

@section('content')
<div>
    <a href="{{url('/dancesports/create')}}" class="addbtn btn btn-lg float-end">
        <i class="fa-solid fa-calendar-plus"></i>
    </a>
    <h1 class="mt-4 title">Dancesports</h1>
    <hr>
    
    <table class="table table-bordered table-striped">
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
            <tr>
                <td class="text-white">{{$contest->title}}</td>
                <td class="text-white">{{$contest->schedule}}</td>
                <td class="text-white">{{$contest->venue}}</td>
                <td class='text-center'>
                    <button type="button" class="btn btn-primary p-1" data-bs-toggle="modal" data-bs-target="#editModal{{$contest->id}}">
                        Edit
                      </button>
                      @include('dancesports.edit-dancesport')
                    <button type="button" class="btn btn-danger p-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{$contest->id}}">
                        Delete
                      </button>
                      @include('dancesports.delete-dancesport')
                    <a href="{{url('/dancesports/' . $contest->id)}}" class="btn btn-sm btn-info p-2">
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
