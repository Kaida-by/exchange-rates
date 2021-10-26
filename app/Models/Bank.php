<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bank extends Model
{
    protected $fillable = [
        'name_bank',
        'description_bank',
        'slug_bank',
    ];

    public function currencies(): BelongsToMany
    {
        return $this->belongsToMany(Currency::class);
    }
}
