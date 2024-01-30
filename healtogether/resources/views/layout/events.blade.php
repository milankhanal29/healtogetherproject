@extends('layout.navbar')
@section('events')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .bg-gradient-primary {
    background-image: linear-gradient(to bottom right, #33b5b5, #05f5f5);
}
.ellipsis {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    /* Adjust this value to control the number of lines displayed (3 lines in this case) */
    -webkit-box-orient: vertical;
    height: 6em; /* Adjust this value to control the maximum height of the text */
}


  
    </style>
    <div class="container">
        <h2 class="mt-4"> Events</h1>
<hr>
@php
    $colorStart = '#caf0f8'; // Start color
    $colorEnd = '#48cae4';   // End color
@endphp

<div class="row">
    @foreach($events as $event)
    <div class="card m-3" style="width: 18rem; background: linear-gradient(to right, {{ $colorStart }}, {{ $colorEnd }}); border-radius: 15px;">
        <div class="card-body">
            @php
                $imageData = base64_encode($event->image);
            @endphp
            <img src="data:image/jpeg;base64,{{ $imageData }}" class="card-img-top" alt="event Image" data-toggle="modal">
            <div class="card-body">
                <h5 class="card-title ellipsis">{{ $event->name }}</h5>
                <p class="card-text">
                    <div class="ellipsis">{{ $event->description }}</div>
                    <a href="#" class="read-more-link">Read More</a>
                </p>
                <p class="card-text"><strong>Date:</strong> {{ $event->date }}</p>
                <p class="card-text"><strong>Price:</strong> NPR {{ number_format($event->price, 2) }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('bookEvent', $event->id) }}" class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

    </div>
    <script>
    // Function to toggle the visibility of the full text
    document.querySelectorAll('.read-more-link').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const descriptionDiv = this.previousElementSibling;

            if (descriptionDiv.style.height === 'auto') {
                // If the description is expanded, collapse it
                descriptionDiv.style.height = '4.5em'; // Adjust this value to your design
                this.textContent = 'Read More';
            } else {
                // If the description is collapsed, expand it
                descriptionDiv.style.height = 'auto';
                this.textContent = 'Read Less';
            }
        });
    });
</script>

@endsection
