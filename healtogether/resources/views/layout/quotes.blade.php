@extends('layout.navbar')

@section('quotes')
<div class="container mt-5">
    <h2>Quotes</h2>
    <div class="row">
        @forelse ($quotes as $quote)
            <div class="col-md-6 mb-4">
                <div class="card" style="background-color: lightyellow;">
                    <div class="card-body">
                        <p class="card-text">{{ $quote['text'] }}</p>
                        <footer class="blockquote-footer">Author: {{ $quote['author'] ?? 'Unknown' }}</footer>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <p>No quotes available.</p>
            </div>
        @endforelse
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            {{ $quotes->links() }}
        </div>
    </div>
</div>
@endsection
