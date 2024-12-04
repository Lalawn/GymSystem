<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return HasMany
     */
    public function authorEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'author_id');
    }

    /**
     * @return HasMany
     */
    public function trainerEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'trainer_id');
    }

    /**
     * @return BelongsToMany
     */
    public function registeredEvents(): BelongsToMany{
        return $this->belongsToMany(Event::class, 'registered_events');
    }

    public function hasRole($role): bool
    {
        return $this->roles->contains('name', $role);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isTrainer(): bool
    {
        return $this->hasRole('trainer');
    }

    public function isUser(): bool
    {
        return $this->hasRole('user');
    }
}
