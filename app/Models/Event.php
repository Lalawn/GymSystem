<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'datetime:Y-m-d\TH:i:sP',
    ];

    protected $dates = ['event_date'];

}
