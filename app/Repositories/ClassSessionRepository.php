<?php

namespace App\Repositories;

use App\Contracts\ClassSessionRepositoryInterface;
use App\Models\ClassSession;

class ClassSessionRepository implements ClassSessionRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        $classSession = ClassSession::select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ])->when(isset($filters['start_date']), function ($query) use ($filters) {
            $query->whereDate('session_date', '>=', $filters['start_date']);
        })->when(isset($filters['end_date']), function ($query) use ($filters) {
            $query->whereDate('session_date', '<=', $filters['end_date']);
        })->paginate(10);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function getAllByLecturer(string $lecturerId, array $filters = [])
    {
        $classSession = ClassSession::select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ])->where('lecturer_id', $lecturerId)
            ->when(isset($filters['start_date']), function ($query) use ($filters) {
                $query->whereDate('session_date', '>=', $filters['start_date']);
            })->when(isset($filters['end_date']), function ($query) use ($filters) {
                $query->whereDate('session_date', '<=', $filters['end_date']);
            })->paginate(10);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function getAllByClass(string $classId, array $filters = [])
    {
        $classSession = ClassSession::select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ])->where('class_id', $classId)
            ->when(isset($filters['start_date']), function ($query) use ($filters) {
                $query->whereDate('session_date', '>=', $filters['start_date']);
            })->when(isset($filters['end_date']), function ($query) use ($filters) {
                $query->whereDate('session_date', '<=', $filters['end_date']);
            })->paginate(10);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function getById(ClassSession $classSession)
    {
        $classSession->select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ]);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function getByPengampu(string $pengampuId)
    {
        $classSession = ClassSession::select([
            'id',
            'pengampu_id',
            'lecturer_id',
            'session_number',
            'class_id',
            'class_name',
            'course_code',
            'course_name',
            'topic',
            'session_date',
            'start_time',
            'end_time',
            'status',
            'is_already_opened',
        ])->where('pengampu_id', $pengampuId)->paginate(10);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function generate(array $data, $sessionAmount)
    {
        // $chunks = array_chunk($data, 1000);

        // foreach ($chunks as $chunk) {
        //     Product::fillAndInsert($chunk);
        // }

        ClassSession::fillAndInsert($data);

        $classSession = ClassSession::latest()->take($sessionAmount)->paginate(10);
        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function update(ClassSession $classSession, array $data)
    {
        $classSession->update($data);

        $classSession = $classSession->refresh()->load(['lecturer']);

        if ($classSession->status === 'opened') {
            $classSession->update([
                'is_already_opened' => true,
            ]);
        }

        return $classSession;
    }

    public function bulkDelete(array $data)
    {
        ClassSession::destroy($data);
    }

    public function createSessionMaterial(ClassSession $classSession, array $data)
    {
        $classSession->learningMaterials()->syncWithoutDetaching($data);

        $classSession->load(['lecturer', 'learningMaterials']);

        return $classSession;
    }

    public function deleteSessionMaterial(ClassSession $classSession, array $data)
    {
        $classSession->learningMaterials()->detach($data);
    }

    public function searchData(array $filters = [], $classSession)
    {

    }
}