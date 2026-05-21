<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LearningMaterial extends Model
{
    use HasUuids;

    protected $fillable = [
        'file_path',
        'original_file_name',
        'file_size',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function classSessions(): BelongsToMany
    {
        return $this->belongsToMany(ClassSession::class, 'session_materials');
    }
}
