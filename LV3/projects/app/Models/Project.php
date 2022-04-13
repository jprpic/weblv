<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'lead_user_id'
    ];

    protected $attributes = [
      'tasks_done' => ''
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'team_lead_id', 'id');
    }

}
