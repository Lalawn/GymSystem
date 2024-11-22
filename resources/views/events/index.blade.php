@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Available Events</h1>

        <div class="row">
            @foreach($events as $event)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <p class="card-text"><strong>Date:</strong> {{ $event->event_date->format('F d, Y') }}</p>
                            <p class="card-text"><strong>Trainer:</strong> {{ $event->trainer->name }}</p>
                            @if(auth()->user()->registeredEvents->contains($event->id))
                                <button class="btn btn-secondary" disabled>Already Signed Up</button>
                            @else
                                <form action="{{ route('events.signup', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
