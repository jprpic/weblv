<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_eng',
        'description',
        'study'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function studies()
    {
        return $this->belongsToMany(Study::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
