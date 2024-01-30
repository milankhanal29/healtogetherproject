@extends('admin.admin-nav')
@section('addevents')
    <div class="container">
        <h1 class="mt-4 mb-4">Add Event</h1>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" id="date" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" name="price" id="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="image">Event Image</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" >
            </div>

            <button type="submit" class="btn btn-primary">Add Event</button>
        </form>
    </div>
@endsection
