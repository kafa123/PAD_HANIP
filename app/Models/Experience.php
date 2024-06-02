<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'position',
        'company_name',
        'field',
        'duration',
        'description',
        'start date',
        'end date'
    ];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
