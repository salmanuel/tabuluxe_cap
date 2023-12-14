@extends('base')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <h1 class="title">Logs</h1>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped custom-table" style="border-color: #6d6d6e;">
            <thead>
                <tr class="custom-table-row">
                    <th>Log</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr class="bg-white">
                    <td class="text-dark">{{$log->log_entry}}</td>
                    
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
