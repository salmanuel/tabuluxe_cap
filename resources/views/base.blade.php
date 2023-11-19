<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <title>Simple Judging</title>
</head>
<body>

    {{-- @include('navbar') --}}
    <nav>
        <!-- sidebar.blade.php -->

        <div class="container-fluid">
            <div class="row">
            <div class="col-1 bg-success vh-100" style="width: 12.67%">
                <div class="sidebar">
                    <div class="sidebar-brand">
                        <a href="{{ url('/') }}" class="text-white">Tabuluxe</a>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url('/judging') }}"><i class="fa fa-check"></i> Judging</a>
                        </li>
                        @if(!auth()->guest())
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/events') }}"><i class="fa fa-plus"></i> Events</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/contests/create') }}"><i class="fa fa-plus"></i> Create</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/contests') }}"><i class="fa fa-users"></i> Contests</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-11" style="width: 87.33%">
                <div>
                    @yield('content')
                </div>
            </div>
            </div>
        </div>

    </nav>

    @include('flash-message')

    @yield('scripts')

</body>
</html>
