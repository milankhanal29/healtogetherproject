@section('admincontent')
@extends('admin.admin-nav')




<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Story List') }}</div>
                <div class="card-body">
                    @if (count($stories) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Story</th>
                                    <th>Author</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stories as $story)
                                    <tr>
                                        <td>{{ $story->title }}</td>
                                        <td>{{ $story->story }}</td>
                                        <td>{{ $story->user->name }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.deleteStory', $story->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No stories found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
