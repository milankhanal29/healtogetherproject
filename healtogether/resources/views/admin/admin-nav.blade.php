<!DOCTYPE html>
<html>

<head>
    <title>Admin Story List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('admin.landing') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.news-upload') }}">
                        <i class="bi bi-newspaper"></i>
                        Add News
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.storylist') }}">
                        <i class="bi bi-list-ul"></i>
                        Story List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.create') }}">
                        <i class="bi bi-list-ul"></i>
                        Add Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.events') }}">
                        <i class="bi bi-list-ul"></i>
                        Event List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.newslist') }}">
                        <i class="bi bi-list-ul"></i>
                        News List
                    </a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('admincontent')
        @yield('landing')
        @yield('event')
        @yield('addevents')

    </div>
</body>

</html>
