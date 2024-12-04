@extends('layouts.app')

@section('content')
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
