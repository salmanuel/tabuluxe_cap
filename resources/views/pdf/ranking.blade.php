<!-- ranking.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Ranking PDF</title>
    <style>
        /* Add your styling for the PDF here */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    @if($contest->computation === "Ranking")
        <div class="row mx-auto">
            {{-- <img src="https://drive.google.com/file/d/1GiRi8TDRkC1DrRriNqIH0d-y9P9gOVuO/view?usp=sharing" alt="Logo" class="w-100 h-auto mx-auto d-block rounded-circle border border-3 border-warning p-2 mt-2 mb-4" style="max-width: 125px; max-height: 125px; object-fit: cover;"> --}}
            <h4 class="mb-2">Tabuluxe</h4>
            <div class="col">
                <h3 class="con_rounds">Contestants Score - {{$round->description}}</h3>

                <hr>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="custom-table-row">
                            <th rowspan="2">Name</th>
                            @foreach($contest->judges as $judge)
                            <th class="text-center" colspan="2">{{$judge->name}}</th>
                            @endforeach
                            <th class="text-center" rowspan="2">Sum of Ranks</th>
                            <th class="text-center" rowspan="2">Final Rank</th>
                            {{-- <th rowspan="2" class="text-center">...</th> --}}
                            <tr class="custom-table-row">
                            @foreach($contest->judges as $judge)
                                <th class="text-center">Score</th>
                                <th class="text-center">Rank</th>
                            @endforeach

                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($computation as $id=>$row)

                        <tr class="text-white">
                            @foreach($row as $rw)
                                <td class="text-center text-white">{!!$rw !!}</td>
                            @endforeach
                            {{-- <td class="text-center">
                                <a href="{{url('/contestants/' . $id)}}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-folder-open"></i>
                                </a>
                            </td> --}}
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if ($contest->computation === "Average")
        <div class="row mx-auto">
            <h4 class="mb-2">Tabuluxe</h4>
            <div class="col">
                <h3 class="con_rounds">Contestants Score - {{ $round->description }}</h3>
                <hr>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="custom-table-row">
                            <th rowspan="2">Name</th>
                            @foreach($contest->judges as $judge)
                                <th class="text-center" colspan="1">{{ $judge->name }}</th>
                            @endforeach
                            <th class="text-center" rowspan="2">Total Score</th>
                            <th class="text-center" rowspan="2">Final Average</th>
                            {{-- <th rowspan="2" class="text-center">...</th> --}}
                            <tr class="custom-table-row">
                                @foreach($contest->judges as $judge)
                                    <th class="text-center">Score</th>
                                @endforeach
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($computation as $id => $row)

                        <tr class="text-white">
                            @foreach($row as $rw)
                                <td class="text-center text-white">{!! $rw !!}</td>
                            @endforeach
                            {{-- <td class="text-center">
                                <a href="{{ url('/contestants/' . $id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-folder-open"></i>
                                </a>
                            </td> --}}
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if($contest->computation === "Complex")

        <div class="row mx-auto">
            <h4 class="mb-2">Tabuluxe</h4>

            <div class="col card-body">
                <h3 class="con_rounds">Contestants Score - {{ $round->description }}</h3>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">Name</th>
                            <th class="text-center" colspan="{{count($contest->judges)}}">TOTAL SCORES</th>
                            <th class="text-center" rowspan="2">Normalized Average</th>
                            {{-- <th rowspan="2" class="text-center">...</th> --}}
                        </tr>
                        <tr class="custom-table-row">

                            @foreach($contest->judges as $judge)
                                <th class="text-center" colspan="1">{{ $judge->name }}</th>
                            @endforeach

                        </tr>

                    </thead>
                    <tbody>
                        @foreach($computation as $comp)
                            <tr>
                                <td>{{$comp[0]->name}}</td>
                                @for($i=1; $i<count($comp)-1; $i++)
                                    <td class="text-center">{{$comp[$i]}}</td>
                                @endfor
                                <td class="text-center">{{number_format($comp[count($comp)-1], 2)}}</td>
                                {{-- <td>

                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif

</body>
</html>
