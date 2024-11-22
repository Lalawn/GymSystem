@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Registered Events</h1>
        <div class="row">
            @forelse($registeredEvents as $event)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">
                                <strong>Date:</strong> {{ $event->event_date->format('F d, Y') }}
                            </p>
                            <p class="card-text">
                                <strong>Trainer:</strong> {{ $event->trainer->name }}
                            </p>
                            <!-- Cancel Signup Button -->
                            <form action="{{ route('events.cancel', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Cancel Signup</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p>You have not registered for any events yet.</p>
            @endforelse
        </div>
    </div>
@endsection
