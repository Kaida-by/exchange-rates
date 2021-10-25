<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bank extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
    ];

    public function currencies(): BelongsToMany
    {
        return $this->belongsToMany(Currency::class);
    }
}
