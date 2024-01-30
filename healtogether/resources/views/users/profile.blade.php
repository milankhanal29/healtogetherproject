@extends('layout.navbar')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="container mt-5">
        <h3>My Stories</h3>
        @isset($stories)
            <ul class="list-group">
                @forelse ($stories as $story)
                    <li class="list-group-item">
                        <h5>{{ $story->title }}</h5>
                        <p>{{ $story->story }}</p>
                        <!-- Add any other details you want to display for each story -->

                        @can('delete', $story)
        <form method="POST" action="{{ route('story.delete', $story) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    @endcan
                    </li>
                @empty
                    <p>No stories found.</p>
                @endforelse
            </ul>
        @else
            <p>No stories found.</p>
        @endisset
    </div>
@endsection
