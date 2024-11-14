<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home.index');
});

Route::get('/calendar', function(){
    return view('home.calendarview');
}) -> name('calendar');

Route::get('/api/events', [EventController::class, 'getEvents']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
