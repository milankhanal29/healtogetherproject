
@extends('admin.admin-nav')
@section('event')
    <div class="container">
        <h1 class="mt-4 mb-4">Event List</h1>

        @if (count($events) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->date }}</td>
                            <td>NRP {{ number_format($event->price, 2) }}</td>
                            <td>
                                
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No events available.</p>
        @endif
    </div>
@endsection
