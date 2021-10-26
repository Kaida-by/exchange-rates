<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Currency extends Model
{
    protected $fillable = [
        'name_currency',
        'slug_currency',
        'short_name_currency',
        'background'
    ];

    public function banks(): BelongsToMany
    {
        return $this->belongsToMany(Bank::class);
    }
}
