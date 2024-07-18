<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'project_id',
        'status',
    ];
    public function projects()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

    public function project_name()
    {
        return $this->belongsTo(Projects::class);
    }
    
}
