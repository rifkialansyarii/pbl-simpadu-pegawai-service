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

        $classSession->load(['lecturer']);

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
        ])->where('id', $classSession->id)->first();

        $classSession->load(['lecturer']);

        return $classSession;
    }

    public function generate(array $data, $sessionAmount)
    {
        // $chunks = array_chunk($data, 1000);

        // foreach ($chunks as $chunk) {
        //     Product::fillAndInsert($chunk);
        // }

        ClassSession::fillAndInsert($data);

        $classSession = ClassSession::latest()->take($sessionAmount)->get();
        $classSession->load(['lecturer']);

        return $classSession;
    }

    public function delete(ClassSession $classSession)
    {
        $classSession->delete();
    }

    public function create(array $data)
    {
        return ClassSession::create($data);
    }

    public function update(ClassSession $classSession, array $data)
    {
        $classSession->update($data);
        return $classSession->refresh()->load(['village', 'district', 'city', 'province', 'citizen']);
    }
}