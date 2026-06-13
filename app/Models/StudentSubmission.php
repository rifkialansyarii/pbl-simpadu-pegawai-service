<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StudentSubmission extends Model
{
    use HasUuids;

    protected $fillable = [
        'assignment_id',
        'student_id',
        'submitted_at',
        'score',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(StudentAssignment::class);
    }

    public function submissionFiles(): BelongsToMany
    {
        return $this->belongsToMany(FileUpload::class, 'student_submission_files', foreignPivotKey: 'submission_id');
    }
}
