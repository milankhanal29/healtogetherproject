@extends('admin.admin-nav')

@section('admincontent')
    <div class="container mt-4">
        <h2>Upload News</h2>
        <form method="POST" action="{{ route('admin.news-upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">News Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
