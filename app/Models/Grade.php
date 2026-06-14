<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasUuids;

    protected $fillable = [
        'student_id',
        'nim',
        'student_name',
        'pengampud_id',
        'class_id',
        'class_name',
        'course_code',
        'course_name',
        'assignment_score',
        'uts_score',
        'uas_score',
        'final_score',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
    ];
}
