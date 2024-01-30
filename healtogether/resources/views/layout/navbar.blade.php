<!DOCTYPE html>
<html>
<head>
    <title>HealTogether - Mental Health Community</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand" href="{{ url('/') }}">HealTogether</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>
               
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/news') }}">News <span class="sr-only">(current)</span></a>
                </li>
                @guest
                @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/survey') }}">Take Survey <span class="sr-only">(current)</span></a>
                </li>
                @endguest
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/quotes') }}">Quotes <span class="sr-only">(current)</span></a>
                </li>
               
               
                <li class="nav-item {{ (request()->is('users/writestory')) ? 'd-none' : '' }}">
                <a href="{{ url('users/writestory') }}"><button type="button" class="btn btn-primary">Write Your Story</button></a>
</li>
</ul>
<ul class="navbar-nav ml-auto">
    @guest
        {{-- User is not logged in, show login and register buttons --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('register') }}">Signup</a>
        </li>
    @else
    <li class="nav-item">
            <a class="nav-link" href="{{ url('profile') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('events') }}">Recommended Events</a>
        </li>
        {{-- User is logged in, show logout button --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="nav-link btn btn-link">Logout</button>
</form>

    @endguest
</ul>



</div>
</nav>
<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

</script>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<div class="container">
        @yield('events')     
        @yield('content')
      
        @yield('news')
        @yield('quotes')

        @yield('custom-scripts')



    </div>
    
</body>
</html>

