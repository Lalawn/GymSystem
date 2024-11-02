@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron text-center bg-light py-5">
            <h1 class="display-4">Welcome to Gym Management System</h1>
            <p class="lead">Your one-stop solution for managing your fitness journey.</p>
            <hr class="my-4">
            <p>Check your upcoming appointments, manage your classes, and more.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Check Calendar</a>
        </div>

        <div id="calendar" style="height: 600px;">
            <header class="header">
                <nav class="navbar">
                    <button class="button is-rounded today">Today</button>
                    <button class="button is-rounded prev">
                        <img alt="prev" src="./images/ic-arrow-line-left.png"
                             srcset="./images/ic-arrow-line-left@2x.png 2x, ./images/ic-arrow-line-left@3x.png 3x">
                    </button>
                    <button class="button is-rounded next">
                        <img alt="prev" src="./images/ic-arrow-line-right.png" srcset="
                ./images/ic-arrow-line-right@2x.png 2x,
                ./images/ic-arrow-line-right@3x.png 3x
              ">
                    </button>
                    <span class="navbar--range"></span>
                </nav>
            </header>
            <main id="app"></main>
        </div>
@endsection
