@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-center bg-light py-5">
            <h1 class="display-4">Welcome to Gym Management System</h1>
            <p class="lead">Your one-stop solution for managing your fitness journey.</p>
            <hr class="my-4">
            <p>Check your upcoming appointments, manage your classes, and more.</p>
            @guest
            <a class="btn btn-primary btn-lg" href="{{route('login')}}" role="button">Login</a>
            @else
                <a class="btn btn-primary btn-lg" href="{{route('calendar')}}" role="button">Check Calendar</a>
            @endif
        </div>

@endsection
