<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin Builder
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return BelongsToMany
     */
    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}