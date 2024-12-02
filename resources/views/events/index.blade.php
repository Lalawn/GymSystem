@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All Events</h1>

        <!-- Show Create Event Button for Trainers and Admins -->
        @if(auth()->user()->isTrainer() || auth()->user()->isAdmin())
            <div class="mb-3">
                <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a>
            </div>
        @endif

        <div class="row">
            @forelse($events as $event)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <p class="card-text"><strong>Date:</strong> {{ $event->event_date->format('F d, Y') }}</p>

                            <!-- Sign Up Button -->
                            @if(!$event->registeredUsers->contains(auth()->user()))
                                <form action="{{ route('events.signup', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Sign Up</button>
                                </form>
                            @else
                                <form action="{{ route('events.cancel', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Cancel Signup</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>No events found.</p>
            @endforelse
        </div>
    </div>
@endsection
