@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Event</h1>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="datetime-local" name="event_date" id="event_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Create Event</button>
        </form>
    </div>
@endsection
