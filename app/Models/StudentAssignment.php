<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasUuids;

    protected $fillable = [
        'class_session_id',
        'title',
        'description',
        'deadline',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function classSession()
    {
        return $this->belongsTo(ClassSession::class, 'class_session_id');
    }

    public function fileUploads(): BelongsToMany
    {
        return $this->belongsToMany(FileUpload::class, 'assignment_attachments');
    }
}
