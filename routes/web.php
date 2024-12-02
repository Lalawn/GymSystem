<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MyRegisteredEventsController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;


Route::get('/', function () {
    return view('home.index');
});

Route::get('/calendar', function(){
    return view('home.calendarview');
}) -> name('calendar');

Route::get('/api/events', [EventController::class, 'getEvents']);

Auth::routes();

Route::get('/my-events', [MyRegisteredEventsController::class, 'myRegisteredEvents'])->name('events.myEvents');

Route::get('/events',[EventController::class, 'index'])->name('events.index');
Route::post('/events/{event}/signup', [EventController::class, 'signup'])->name('events.signup');
Route::delete('/events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create')->middleware('auth');
Route::post('/events', [EventController::class, 'store'])->name('events.store')->middleware('auth');

Route::get('/telegram', [BotController::class, 'show'])->name('bot.telegram');
