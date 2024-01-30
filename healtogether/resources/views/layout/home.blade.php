<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .bg-gradient-primary {
    background-image: linear-gradient(to bottom right, #33b5b5, #05f5f5);
}


  
    </style>
  

</head>
<body class="bg-gray">
@extends('layout.navbar')

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


@section('content')



    
<br>
<h2>People's Stories</h2>
<hr>
@php
    $colorStart = '#caf0f8'; // Start color
    $colorEnd = '#48cae4';   // End color
@endphp

<!-- <div class="container">
<h1>Clustering Results</h1>
    <button id="getClustersBtn" class="btn btn-primary">Get Clustering Results</button>
    <div id="clustersContainer"></div> -->
<div class="row">

    @foreach ($stories as $story)
        <div class="card m-3" style="width: 18rem; background: linear-gradient(to right, {{ $colorStart }}, {{ $colorEnd }}); border-radius: 15px;">
            <div class="card-body">
                <h5 class="card-title">user100{{ $story->user->id }}</h5>
                <hr>
                <h6 class="card-subtitle mb-2 text-muted">{{ $story->created_at->format('F d, Y') }}</h6>
                <p class="card-text">
                    @if (str_word_count($story->story) > 20)
                        {{ substr($story->story, 0, 150) . '...' }}
                    @else
                        {{ $story->story }}
                    @endif
                </p>
                @if (str_word_count($story->story) > 20)
                    <a href="{{ route('story.show', $story->id) }}" class="card-link">Read More</a>
                @endif
                <a href="{{ route('story.show', $story->id) }}" class="card-link">Comment</a>
            </div>
        </div>
    @endforeach
</div>

</div>



<!-- Quotes Section -->
<div class="container mt-5">
    <h2 class="mb-4">What they Said!</h2>
    <hr>
    <div class="row">
        <!-- Left Quote -->
        <div class="col-md-6 mb-3">
            <div class="card bg-gradient-primary text-white position-relative" style=" border-radius: 15px; transform: rotate(-10deg);">
                <img src="{{ asset('assets/images/person1.jpg') }}" alt="Person 1" class="card-img-top rounded-circle" style="height: 200px; width: 200px; object-fit: cover;">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p class="card-text">“It’s something that’s extremely common, one in five adults has a mental illness, so basically everyone is essentially connected to this problem and this epidemic.”</p>
                        <footer class="blockquote-footer">Quote by <cite title="Source Title">Demi Lovato</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>

        <!-- Right Quote -->
        <div class="col-md-6 mb-3">
            <div class="card bg-gradient-primary text-white position-relative" style=" border-radius: 15px; transform: rotate(10deg);">
                <img src="{{ asset('assets/images/person2.jpg') }}" alt="Person 2" class="card-img-top rounded-circle" style="height: 200px; width: 200px; object-fit: cover;">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p class="card-text">"What I would tell kids going through anxiety, which I have and can relate to, is that you’re so normal. Everyone experiences a version of anxiety or worry in their lives, and maybe we go through it in a different or more intense way for longer periods of time, but there’s nothing wrong with you. To be a sensitive person that cares a lot, that takes things in in a deep way is actually part of what makes you amazing… I wouldn’t trade it for the world, even when there are really hard times. Don’t ever feel like you’re a weirdo for it because we’re all weirdos."</p>
                        <footer class="blockquote-footer">Quote by <cite title="Source Title">Emma Stone</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('events')
    @include('layout.events')
@endsection
@section('news')
    @include('layout.news')
@endsection
@section('quotes')
    @include('layout.quotes')
@endsection


</body>


</html>
