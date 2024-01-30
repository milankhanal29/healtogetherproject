@extends('layout.navbar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Comments') }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $story->title }}</h5>
                        <p class="card-text">{{ $story->story }}</p>

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @foreach ($comments as $comment)
                            <div class="mb-3">
                                <strong> user100{{ $comment->user->id }}</strong> said:
                                <p>{{ $comment->comment }}</p>
                            </div>
                        @endforeach

                        <form method="POST" action="{{ route('comment.submit', $story->id) }}">
                            @csrf

                            <div class="form-group">
                                <label for="comment">{{ __('Your Comment') }}</label>
                                <textarea id="comment" class="form-control @error('comment') is-invalid @enderror"
                                          name="comment" rows="3" required>{{ old('comment') }}</textarea>
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
