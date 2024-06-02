<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable =[
        'student_id',
        'skill',
        'achievement name',
        'achievement type',
        'achievement level',
        'achievement year',
        'description'
    ];

    public function Student() {
        return $this->belongsTo(Skill::class, 'student_id', 'id');
    }
}
