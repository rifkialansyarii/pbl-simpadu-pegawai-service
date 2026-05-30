<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassSession extends Model
{
    /** @use HasFactory<\Database\Factories\ClassSessionFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'pengampu_id',
        'lecturer_id',
        'class_id',
        'course_name',
        'topic',
        'session_date',
        'start_time',
        'end_time',
        'status',
        'is_already_opened',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'lecturer_id');
    }

    public function learningMaterials(): BelongsToMany
    {
        return $this->belongsToMany(FileUpload::class, 'session_materials')->withTimestamps();
    }
}
