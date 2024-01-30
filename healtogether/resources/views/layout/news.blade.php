@extends('layout.navbar')

@section('news')
<style>
    .news-card {
        height: 300px; /* Fixed height for the card */
        overflow: hidden; /* Hide any overflow content */
    }

    .news-card img {
        width: 100%; /* Set the width of the image to fill the card */
        height: 200px; /* Set the height of the image */
        object-fit: cover; /* Scale the image while maintaining aspect ratio */
        cursor: pointer; /* Add a pointer cursor to indicate clickable image */
    }
</style>

<div class="container mt-5">
    <h2>Latest News</h2>
    <div class="row">
        @foreach ($news as $singleNews)
            <div class="col-md-6 mb-4">
                <div class="card news-card">
                    @php
                        $imageData = base64_encode($singleNews->image);
                    @endphp
                    <img src="data:image/jpeg;base64,{{ $imageData }}" class="card-img-top" alt="News Image" data-toggle="modal" data-target="#newsModal{{ $singleNews->id }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $singleNews->title }}</h5>
                        <p class="card-text">{{ $singleNews->content }}</p>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="newsModal{{ $singleNews->id }}" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel{{ $singleNews->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newsModalLabel{{ $singleNews->id }}">{{ $singleNews->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="data:image/jpeg;base64,{{ $imageData }}" class="img-fluid" alt="News Image">
                            <p>{{ $singleNews->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
