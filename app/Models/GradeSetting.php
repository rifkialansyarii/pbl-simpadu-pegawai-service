<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradeSetting extends Model
{
    use HasUuids;

    protected $fillable = [
        'lecturer_id',
        'course_code',
        'course_name',
        'assignment',
        'uts',
        'uas',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
    ];

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'lecturer_id');
    }
}
