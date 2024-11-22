<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_date',
        'description'
    ];

    protected $casts = [
        'event_date' => 'datetime:Y-m-d\TH:i:sP',
    ];

    protected $dates = ['event_date'];

    public function author(): belongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function trainer(): belongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function registeredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'registered_events');
    }
}
