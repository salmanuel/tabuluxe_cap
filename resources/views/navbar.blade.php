<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}">Simple Judging</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link" href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
          <a class="nav-link" href="{{url('/judging')}}"><i class="fa fa-check"></i> Judging</a>
          @if(!auth()->guest())
            <a class="nav-link" href="{{url('/contests/create')}}"><i class="fa fa-plus"></i> Create</a>
            <a class="nav-link" href="{{url('/contests')}}"><i class="fa fa-users"></i> Contests</a>
            <a class="nav-link" href="{{url('/logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
          @endif

        </div>
      </div>
    </div>
</nav>
