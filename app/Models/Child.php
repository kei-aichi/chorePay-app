<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function choreRecords(): HasMany
    {
        return $this->hasMany(ChoreRecord::class);
    }
}
