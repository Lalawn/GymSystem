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

Route::get('/my-events', [EventController::class, 'myRegisteredEvents'])->name('events.myEvents');

Route::get('/events',[EventController::class, 'index'])->name('events.index');

Route::post('/events/{event}/signup', [EventController::class, 'signup'])->name('events.signup');

Route::delete('/events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
