<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public const STRUCNI = 1;
    public const PREDDIPLOMSKI = 2;
    public const DIPLOMSKI = 3;

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
