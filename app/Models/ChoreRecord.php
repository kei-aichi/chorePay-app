<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoreRecord extends Model
{
    use HasFactory;

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
