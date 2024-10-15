<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    {{-- <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="{{asset('js/jquery-3.5.1.slim.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <title>Tabuluxe</title>
</head>
<body>

    {{-- @include('navbar') --}}
    <nav>

        <div class="container-fluid">
            <div class="row">
            <div class="col-1 vh-100 " style="width: 12.10%">

                    <div class="sidebar">
                        <div class="sidebar-brand mb-3 text-center">
                            @if(!auth()->guest() && $sidebarLogo)
                                <img src="{{ asset($sidebarLogo->photo) }}" alt="Logo" class="w-100 h-auto mx-auto d-block rounded-circle border border-3 border-warning p-2 mt-2 mb-4" style="max-width: 125px; max-height: 125px; object-fit: cover;" type="button" data-bs-toggle="modal" data-bs-target="#editModal{{auth()->user()->id}}">

                            @endif

                            @if(auth()->guest())
                                <img src="/images/logo.png" alt="Logo" class="w-100 h-auto mx-auto d-block rounded-circle border border-3 border-warning p-2 mt-2 mb-4" style="max-width: 125px; max-height: 125px; object-fit: cover;">
                            @endif

                            @if(!auth()->guest())
                                <a href="{{ url('/') }}" class="site_name">{{ auth()->user()->name }}</a>
                            @endif

                        </div>
                        <ul class="main-nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ url('/judging') }}"><i class="fa-solid fa-gavel"></i> Judging</a>
                            </li>
                            @if(!auth()->guest())
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ url('/events') }}"><i class="fa-regular fa-calendar-days"></i> Events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ url('/dancesports') }}"><i class="fa-solid fa-person-walking"></i> Dancesports</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ url('/logs') }}"><i class="fa-solid fa-list"></i> Logs</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link " href="{{ url('/contests/create') }}"><i class="fa fa-plus"></i> Create</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ url('/contests') }}"><i class="fa fa-users"></i> Contests</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>


            <div class="col-11 bg-secondary" style="width: 87.88%">
                @include('flash-message')
                @if(!auth()->guest())
                    @include('profile.edit')
                @endif

                @yield('content')
                <div class="position-fixed bottom-0 start-50 translate-middle-x p-2 text-center" style="color: #080d32">
                    <p class="m-0"><i class="fa-regular fa-copyright"></i> MDC Code Breakers</p>
                </div>
            </div>
            </div>
        </div>

    </nav>


    @yield('scripts')

</body>
</html>

<style scoped>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 12.67%;
    background-color: #080d32;

}

.main-nav {
    list-style: none;
    padding: 0;
    /* margin: 0; */
}

.main-nav li {
    margin: 0;
}

.main-nav a {
    display: block;
    padding: 1rem 0.5rem;
    padding-left: 30px;
    color: #ffbd59;
    /* font-family: 'Poppins'; */
    font-size: 0.825rem;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    transition background-color 0.5s, color 0.5s;
    text-decoration: none;
    /* text-align: center; */
}

.main-nav a:hover {
    background: linear-gradient(to right, #ffbd59, #b2a7a7);
    color: #080d32;
}

* {
    font-family: 'Poppins';
}

.site_name {
    text-decoration: none;
    color: #ffbd59;
    text-transform: uppercase;
    text-align: center;
}

.site_name:hover {
    color: white;
}
</style>
