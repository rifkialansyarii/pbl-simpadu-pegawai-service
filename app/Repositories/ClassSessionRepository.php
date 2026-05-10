<?php

namespace App\Repositories;

use App\Contracts\ClassSessionRepositoryInterface;
use App\Models\ClassSession;

class ClassSessionRepository implements ClassSessionRepositoryInterface
{
    public function getAll()
    {
        $classSession = ClassSession::select([
            'id',
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
        ])->paginate(10);

        return $classSession;
    }

    public function getById(ClassSession $classSession)
    {
        $classSession = ClassSession::select([
            'id',
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
        ])->paginate(10);


        return $classSession;
    }

    public function delete(ClassSession $classSession)
    {
        $classSession->delete();
    }

    public function create(array $attributes)
    {
        return ClassSession::create($attributes);
    }

    public function update(ClassSession $classSession, array $attributes)
    {
        $classSession->update($attributes);
        return $classSession->refresh()->load(['village', 'district', 'city', 'province', 'citizen']);
    }
}