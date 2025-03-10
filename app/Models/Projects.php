<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
